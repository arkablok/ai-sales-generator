<?php

namespace App\Http\Controllers;

use App\Models\SalesPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SalesPageController extends Controller
{

    public function create()
    {
        return view('sales.create');
    }
    
    public function edit(SalesPage $salesPage)
    {
        if ($salesPage->user_id !== auth()->id()) {
            abort(403);
        }
        return view('sales.edit', compact('salesPage'));
    }

    public function update(Request $request, SalesPage $salesPage)
    {
        if ($salesPage->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'generated_output' => 'required|string',
        ]);

        $salesPage->update([
            'generated_output' => $request->generated_output
        ]);

        return redirect()->route('sales.preview', $salesPage->id)
            ->with('success', 'Sales page updated successfully!');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'features' => 'required|string',
            'target_audience' => 'required|string',
            'price' => 'required|numeric|min:0',
            'unique_selling_points' => 'nullable|string',
        ]);

        $prompt = $this->buildPrompt($request);

        $apiKey = env('GEMINI_API_KEY');

        $model = 'gemini-2.5-flash-lite';
        
        try {
            $response = Http::timeout(120)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'maxOutputTokens' => 10000,
                    ]
                ]
            );

            if (!$response->successful()) {
                throw new \Exception('Gemini API error: ' . $response->body());
            }

            $result = $response->json();
            $generatedHtml = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

            $generatedHtml = $this->cleanHtml($generatedHtml);

            $salesPage = SalesPage::create([
                'user_id' => auth()->id(),
                'product_name' => $request->product_name,
                'description' => $request->description,
                'features' => $request->features,
                'target_audience' => $request->target_audience,
                'price' => $request->price,
                'unique_selling_points' => $request->unique_selling_points,
                'generated_output' => $generatedHtml,
            ]);

            return redirect()->route('sales.preview', $salesPage->id)
                ->with('success', 'Sales page generated successfully!');

        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            return back()->with('error', 'Generation failed: ' . $e->getMessage());
        }
    }

    public function regenerateSection(Request $request, SalesPage $salesPage)
    {
        if (auth()->id() !== $salesPage->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'section' => 'required|string|in:headline,subheadline,hero,description,benefits,features,testimonial,pricing,cta',
        ]);

        $section = $request->section;
        $currentHtml = $salesPage->generated_output;

        $sectionPrompts = [
            'headline' => "Extract ONLY the main H1 headline section from this HTML and rewrite it to be more compelling and attention-grabbing. Return ONLY the HTML for that section. Keep the same styling classes.\n\nHTML:\n{$currentHtml}",
            
            'subheadline' => "Extract ONLY the subheadline section from this HTML and rewrite it to be more persuasive and clear. Return ONLY the HTML for that section.\n\nHTML:\n{$currentHtml}",
            
            'hero' => "Rewrite the entire hero section (headline, subheadline, hero image placeholder, and primary CTA button) of this sales page. Make it more powerful and emotionally engaging. Return ONLY the hero section HTML.\n\nHTML:\n{$currentHtml}",
            
            'description' => "Rewrite the product description section to be more compelling, clear, and focused on customer benefits. Return ONLY the description section HTML.\n\nHTML:\n{$currentHtml}",
            
            'benefits' => "Rewrite the benefits list section. Create 4-6 powerful benefits with placeholder icons. Each benefit should solve a customer pain point. Return ONLY the benefits section HTML.\n\nHTML:\n{$currentHtml}",
            
            'features' => "Rewrite the features breakdown grid section. Create 3-4 detailed features with better descriptions. Return ONLY the features grid section HTML.\n\nHTML:\n{$currentHtml}",
            
            'testimonial' => "Create a new authentic-sounding testimonial section with a customer quote, name, title, and rating. Make it believable and persuasive. Return ONLY the testimonial section HTML.\n\nHTML:\n{$currentHtml}",
            
            'pricing' => "Rewrite the pricing display section. Show price: \${$salesPage->price}. Add a value proposition and guarantee. Make urgency clear. Return ONLY the pricing section HTML.\n\nHTML:\n{$currentHtml}",
            
            'cta' => "Rewrite the final call-to-action section. Create urgency, restate the main benefit, and make the button text action-oriented. Return ONLY the CTA section HTML.\n\nHTML:\n{$currentHtml}",
        ];

        $prompt = $sectionPrompts[$section];
        $prompt .= "\n\nIMPORTANT: Return ONLY the HTML for the {$section} section. No explanations, no markdown formatting, no code blocks. Just pure HTML.";

        $apiKey = env('GEMINI_API_KEY');
        $model = 'gemini-2.5-flash-lite';

        try {
            $response = Http::timeout(60)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.8,
                        'maxOutputTokens' => 3000,
                    ]
                ]
            );

            if (!$response->successful()) {
                $errorData = $response->json();
                $errorMsg = $errorData['error']['message'] ?? $response->body();
                throw new \Exception('API error: ' . $errorMsg);
            }

            $result = $response->json();
            $newSectionHtml = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';
            $newSectionHtml = $this->cleanHtml($newSectionHtml);
            $updatedHtml = $this->replaceSectionInHtml($currentHtml, $section, $newSectionHtml);

            $salesPage->update(['generated_output' => $updatedHtml]);

            return response()->json([
                'success' => true,
                'html' => $updatedHtml,
                'section' => $section,
                'message' => ucfirst($section) . ' regenerated successfully!'
            ]);

        } catch (\Exception $e) {
            Log::error('Section regeneration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to regenerate: ' . $e->getMessage()
            ], 500);
        }
    }

    private function replaceSectionInHtml($fullHtml, $section, $newSectionHtml)
    {
        $patterns = [
            'headline' => '/(<h1[^>]*>.*?<\/h1>)/is',
            'subheadline' => '/(<h2[^>]*class="[^"]*subheadline[^"]*"[^>]*>.*?<\/h2>|<div[^>]*class="[^"]*subheadline[^"]*"[^>]*>.*?<\/div>)/is',
            'hero' => '/(<div[^>]*class="[^"]*hero[^"]*"[^>]*>.*?<\/div>|<section[^>]*class="[^"]*hero[^"]*"[^>]*>.*?<\/section>)/is',
            'description' => '/(<div[^>]*class="[^"]*description[^"]*"[^>]*>.*?<\/div>)/is',
            'benefits' => '/(<div[^>]*class="[^"]*benefits[^"]*"[^>]*>.*?<\/div>)/is',
            'features' => '/(<div[^>]*class="[^"]*features[^"]*"[^>]*>.*?<\/div>)/is',
            'testimonial' => '/(<div[^>]*class="[^"]*testimonial[^"]*"[^>]*>.*?<\/div>)/is',
            'pricing' => '/(<div[^>]*class="[^"]*pricing[^"]*"[^>]*>.*?<\/div>)/is',
            'cta' => '/(<div[^>]*class="[^"]*cta[^"]*"[^>]*>.*?<\/div>)/is',
        ];

        if (isset($patterns[$section]) && preg_match($patterns[$section], $fullHtml, $matches)) {
            return preg_replace($patterns[$section], $newSectionHtml, $fullHtml, 1);
        }

        return $fullHtml;
    }

    private function buildPrompt($request)
    {
        return "Create a complete, modern, responsive sales page HTML/CSS for the following product:

Product Name: {$request->product_name}
Description: {$request->description}
Features: {$request->features}
Target Audience: {$request->target_audience}
Price: $" . number_format($request->price, 2) . "
Unique Selling Points: " . ($request->unique_selling_points ?: 'None') . "

IMPORTANT INSTRUCTIONS:
1. Output must be COMPLETE HTML (with <!DOCTYPE html>, <head>, <style>, <body>)
2. Use Tailwind CSS or modern beautiful CSS
3. Include these components with SPECIFIC CSS CLASSES:
   - hero section (class=\"hero-section\")
   - headline: h1 (class=\"main-headline\")
   - subheadline: h2 or div (class=\"subheadline\")
   - description section (class=\"description-section\")
   - benefits section (class=\"benefits-section\")
   - features grid (class=\"features-section\")
   - testimonial section (class=\"testimonial-section\")
   - pricing section (class=\"pricing-section\")
   - cta section (class=\"cta-section\")
4. Design must be professional, modern, and mobile responsive
5. Don't add any text outside HTML, return only HTML
6. Use attractive colors matching the product type
7. Use ENGLISH language for all text in the sales page
8. Keep HTML clean and well-structured";
    }

    private function cleanHtml($content)
    {
        $content = preg_replace('/```html\s*/i', '', $content);
        $content = preg_replace('/```\s*$/i', '', $content);
        $content = preg_replace('/^```\s*/', '', $content);
        $content = preg_replace('/```/i', '', $content);
        $content = preg_replace('/^html\s*/i', '', $content);
        return trim($content);
    }

    public function preview(SalesPage $salesPage)
    {
        if (auth()->id() !== $salesPage->user_id) {
            abort(403, 'Unauthorized action.');
        }
        return view('sales.preview', compact('salesPage'));
    }

    public function history(Request $request)
    {
        $query = SalesPage::where('user_id', auth()->id());
        
        if ($request->has('search') && $request->search) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }
        
        $salesPages = $query->latest()->paginate(10);
        
        return view('sales.history', compact('salesPages'));
    }

    public function destroy(SalesPage $salesPage)
    {
        if (auth()->id() !== $salesPage->user_id) {
            abort(403, 'Unauthorized action.');
        }
        $salesPage->delete();
        
        return redirect()->route('sales.history')
            ->with('success', 'Sales page deleted successfully!');
    }

    public function regenerate(SalesPage $salesPage)
    {
        if (auth()->id() !== $salesPage->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $request = new Request([
            'product_name' => $salesPage->product_name,
            'description' => $salesPage->description,
            'features' => $salesPage->features,
            'target_audience' => $salesPage->target_audience,
            'price' => $salesPage->price,
            'unique_selling_points' => $salesPage->unique_selling_points,
        ]);
        
        return $this->generate($request);
    }

    public function export(SalesPage $salesPage)
    {
        if (auth()->id() !== $salesPage->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $filename = $salesPage->product_name . '_sales_page.html';
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
        
        return response($salesPage->generated_output)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}