<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $salesPage->product_name }} - Live Preview
            </h2>
            <div class="space-x-2">
                <a href="{{ route('sales.edit', $salesPage) }}" 
                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition inline-block">
                    ✏️ Edit Page
                </a>
                <a href="{{ route('sales.export', $salesPage) }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition inline-block">
                    📥 Download HTML
                </a>
                <a href="{{ route('sales.history') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition inline-block">
                    ← Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-4 bg-gray-100">
        <div class="max-w-full mx-auto px-4">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Toolbar Preview -->
            <div class="bg-white rounded-t-xl shadow-lg p-4 flex justify-between items-center flex-wrap gap-4 border-b">
                <div class="flex gap-2 bg-gray-100 rounded-lg p-1">
                    <button id="btnDesktop" 
                        class="px-4 py-2 rounded-lg text-sm font-medium transition bg-indigo-600 text-white">
                        🖥️ Desktop
                    </button>
                    <button id="btnMobile" 
                        class="px-4 py-2 rounded-lg text-sm font-medium transition bg-gray-200 text-gray-700 hover:bg-gray-300">
                        📱 Mobile
                    </button>
                </div>
                <div class="text-sm text-gray-500">
                    🔍 Preview Mode | <span id="frameSizeLabel">Desktop (100%)</span>
                </div>
                <button id="refreshFrame" class="text-gray-500 hover:text-indigo-600 transition">
                    🔄 Refresh Preview
                </button>
            </div>

            <!-- Frame Preview dengan Browser Mockup -->
            <div class="bg-gray-800 rounded-b-xl shadow-2xl p-4">
                <div class="bg-gray-900 rounded-lg overflow-hidden">
                    <!-- Browser Bar -->
                    <div class="bg-gray-800 px-4 py-2 flex items-center gap-2 border-b border-gray-700">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="flex-1 mx-4">
                            <div class="bg-gray-700 rounded-md px-3 py-1 text-gray-400 text-sm text-center">
                                {{ $salesPage->product_name }} - Live Preview
                            </div>
                        </div>
                        <div class="w-16"></div>
                    </div>
                    
                    <!-- IFrame Container -->
                    <div id="iframeContainer" class="overflow-auto bg-white" style="height: 70vh;">
                        <iframe 
                            id="previewFrame"
                            src="{{ route('render.html', $salesPage->id) }}"
                            class="border-0 transition-all duration-300"
                            style="width: 100%; height: 100%;"
                            title="Sales Page Preview">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="mt-4 text-center text-sm text-gray-500">
                💡 Tip: Klik Edit Page untuk memperbaiki atau menambahkan kode HTML yang kurang lengkap
            </div>
        </div>
    </div>

    <style>
        #iframeContainer {
            transition: all 0.3s ease;
        }
        
        .mobile-mode {
            max-width: 375px !important;
            margin: 0 auto !important;
        }
        
        .desktop-mode {
            max-width: 100% !important;
            margin: 0 !important;
        }
    </style>

    <script>
        const iframeContainer = document.getElementById('iframeContainer');
        const previewFrame = document.getElementById('previewFrame');
        const btnDesktop = document.getElementById('btnDesktop');
        const btnMobile = document.getElementById('btnMobile');
        const refreshBtn = document.getElementById('refreshFrame');
        const frameSizeLabel = document.getElementById('frameSizeLabel');
        
        // Desktop mode
        btnDesktop.addEventListener('click', function() {
            iframeContainer.classList.remove('mobile-mode');
            iframeContainer.classList.add('desktop-mode');
            
            btnDesktop.className = 'px-4 py-2 rounded-lg text-sm font-medium transition bg-indigo-600 text-white';
            btnMobile.className = 'px-4 py-2 rounded-lg text-sm font-medium transition bg-gray-200 text-gray-700 hover:bg-gray-300';
            
            frameSizeLabel.innerText = 'Desktop (100%)';
        });
        
        // Mobile mode (iPhone size 375px)
        btnMobile.addEventListener('click', function() {
            iframeContainer.classList.remove('desktop-mode');
            iframeContainer.classList.add('mobile-mode');
            
            btnMobile.className = 'px-4 py-2 rounded-lg text-sm font-medium transition bg-indigo-600 text-white';
            btnDesktop.className = 'px-4 py-2 rounded-lg text-sm font-medium transition bg-gray-200 text-gray-700 hover:bg-gray-300';
            
            frameSizeLabel.innerText = 'Mobile (375px)';
        });
        
        // Refresh preview
        refreshBtn.addEventListener('click', function() {
            const currentSrc = previewFrame.src;
            previewFrame.src = '';
            setTimeout(() => {
                previewFrame.src = currentSrc;
            }, 100);
        });
    </script>
</x-app-layout>