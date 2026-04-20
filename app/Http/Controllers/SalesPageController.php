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

        $model = 'gemini-2.5-flash';
        
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
                        'temperature' => 0.7,
                        'maxOutputTokens' => 4096,
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
3. Include these components:
   - Attention-grabbing headline
   - Subheadline
   - Hero section with placeholder image
   - Product description
   - Benefits list (use placeholder icons)
   - Features breakdown (grid layout)
   - Social proof placeholder (dummy testimonial)
   - Pricing display with CTA button
   - Clear call-to-action
4. Design must be professional, modern, and mobile responsive
5. Don't add any text outside HTML, return only HTML
6. Use attractive colors matching the product type
7. Use ENGLISH language for all text in the sales page";
    }

    private function cleanHtml($content)
    {
        $content = preg_replace('/```html\s*/i', '', $content);
        $content = preg_replace('/```\s*$/i', '', $content);
        return $content;
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