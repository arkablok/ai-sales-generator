<?php

namespace App\Http\Controllers;

use App\Models\SalesPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SalesPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan form
    public function create()
    {
        return view('sales.create');
    }

    // Generate dengan Gemini API
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

        // Buat prompt untuk Gemini
        $prompt = $this->buildPrompt($request);

        // Panggil Gemini API
        $apiKey = env('GEMINI_API_KEY');
        
        try {
            $response = Http::timeout(60)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}",
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

            // Bersihkan markdown jika ada
            $generatedHtml = $this->cleanHtml($generatedHtml);

            // Simpan ke database
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
                ->with('success', 'Sales page berhasil digenerate!');

        } catch (\Exception $e) {
            Log::error('Gemini API Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal generate: ' . $e->getMessage());
        }
    }

    private function buildPrompt($request)
    {
        return "Buatkan sebuah sales page HTML/CSS yang lengkap, modern, dan responsif untuk produk berikut:

Nama Produk: {$request->product_name}
Deskripsi: {$request->description}
Fitur-fitur: {$request->features}
Target Audiens: {$request->target_audience}
Harga: Rp " . number_format($request->price, 0, ',', '.') . "
Unique Selling Points: " . ($request->unique_selling_points ?: 'Tidak ada') . "

INSTRUKSI PENTING:
1. Hasil harus berupa HTML LENGKAP (dengan <!DOCTYPE html>, <head>, <style>, <body>)
2. Gunakan Tailwind CSS atau CSS modern yang bagus
3. Sertakan komponen berikut:
   - Headline yang menarik
   - Subheadline
   - Hero section dengan gambar placeholder
   - Deskripsi produk
   - Daftar benefit (gunakan icon placeholder)
   - Breakdown fitur (grid layout)
   - Social proof placeholder (testimoni dummy)
   - Pricing display dengan CTA button
   - Call-to-action yang jelas
4. Desain harus profesional, modern, dan mobile responsive
5. Jangan tambahkan teks di luar HTML, langsung berikan HTML-nya saja
6. Gunakan warna yang menarik dan sesuai dengan jenis produk";
    }

    private function cleanHtml($content)
    {
        // Hapus markdown code blocks jika ada
        $content = preg_replace('/```html\s*/i', '', $content);
        $content = preg_replace('/```\s*$/i', '', $content);
        return $content;
    }

    // Preview sales page
    public function preview(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);
        return view('sales.preview', compact('salesPage'));
    }

    // History page
    public function history(Request $request)
    {
        $query = SalesPage::where('user_id', auth()->id());
        
        if ($request->has('search') && $request->search) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }
        
        $salesPages = $query->latest()->paginate(10);
        
        return view('sales.history', compact('salesPages'));
    }

    // Delete
    public function destroy(SalesPage $salesPage)
    {
        $this->authorize('delete', $salesPage);
        $salesPage->delete();
        
        return redirect()->route('sales.history')
            ->with('success', 'Sales page berhasil dihapus!');
    }

    // Regenerate (bonus)
    public function regenerate(SalesPage $salesPage)
    {
        $this->authorize('update', $salesPage);
        
        // Buat request object dari data yang tersimpan
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

    // Export HTML
    public function export(SalesPage $salesPage)
    {
        $this->authorize('view', $salesPage);
        
        $filename = $salesPage->product_name . '_sales_page.html';
        $filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
        
        return response($salesPage->generated_output)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}