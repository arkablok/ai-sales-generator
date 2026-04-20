<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ✏️ Edit Sales Page - {{ $salesPage->product_name }}
            </h2>
            <a href="{{ route('sales.preview', $salesPage) }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                ← Back to Preview
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Editor Panel -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                        <h3 class="text-white font-semibold">📝 HTML Editor</h3>
                        <p class="text-indigo-100 text-sm">Edit the HTML/CSS code directly</p>
                    </div>
                    <div class="p-4">
                        <form method="POST" action="{{ route('sales.update', $salesPage) }}">
                            @csrf
                            @method('PUT')
                            <textarea name="generated_output" rows="25" 
                                class="w-full rounded-lg border-gray-300 font-mono text-sm focus:border-indigo-500 focus:ring-indigo-500"
                                style="font-family: monospace;">{{ $salesPage->generated_output }}</textarea>
                            <div class="flex justify-end gap-3 mt-4">
                                <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                                    💾 Save Changes
                                </button>
                                <a href="{{ route('sales.regenerate', $salesPage) }}" 
                                    onclick="return confirm('Regenerate with AI? This will overwrite your changes.')"
                                    class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition inline-block">
                                    🤖 Regenerate with AI
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Live Preview Panel -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gray-800 px-4 py-2">
                        <span class="text-white text-sm">🔍 Live Preview</span>
                    </div>
                    <div class="p-0 h-[600px] overflow-auto">
                        <iframe id="livePreview" class="w-full h-full border-0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Live preview update on every keystroke
        const textarea = document.querySelector('textarea[name="generated_output"]');
        const iframe = document.getElementById('livePreview');
        
        function updatePreview() {
            const content = textarea.value;
            const srcdoc = content;
            iframe.srcdoc = srcdoc;
        }
        
        textarea.addEventListener('input', updatePreview);
        updatePreview(); // Initial preview
    </script>
</x-app-layout>