<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-2">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $salesPage->product_name }}
                    </h2>
                    <p class="text-sm text-gray-500">Live Preview</p>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('sales.edit', $salesPage) }}" 
                   class="bg-gradient-to-r from-emerald-500 to-green-600 text-white px-4 py-2 rounded-lg hover:from-emerald-600 hover:to-green-700 transition-all duration-200 shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Page
                </a>
                <a href="{{ route('sales.export', $salesPage) }}" 
                   class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-cyan-700 transition-all duration-200 shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Download HTML
                </a>
                <a href="{{ route('sales.history') }}" 
                   class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all duration-200 shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-full mx-auto px-4">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 rounded-lg flex items-start gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="flex-1">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-4">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <div class="flex gap-2 bg-white/20 backdrop-blur-sm rounded-lg p-1">
                            <button id="btnDesktop" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-white/30 text-white backdrop-blur-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Desktop
                            </button>
                            <button id="btnMobile" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-white/10 text-white/80 hover:bg-white/20 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Mobile
                            </button>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2 text-white/80 text-sm bg-white/20 backdrop-blur-sm px-3 py-1 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span id="frameSizeLabel">Desktop View</span>
                            </div>
                            <button id="refreshFrame" class="text-white/80 hover:text-white transition-all duration-200 bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 p-6">
                    <div class="bg-gray-950 rounded-xl overflow-hidden shadow-2xl">
                        <div class="bg-gray-800 px-4 py-3 flex items-center gap-2 border-b border-gray-700">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500 shadow-sm"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500 shadow-sm"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500 shadow-sm"></div>
                            </div>
                            <div class="flex-1 mx-4">
                                <div class="bg-gray-700 rounded-md px-3 py-1 text-gray-300 text-sm text-center flex items-center justify-center gap-2">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $salesPage->product_name }} - Live Preview
                                </div>
                            </div>
                            <div class="w-16"></div>
                        </div>
                        
                        <div id="iframeContainer" class="overflow-auto bg-white transition-all duration-300" style="height: 70vh;">
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
            </div>

            <div class="mt-6 text-center">
                <div class="inline-flex items-center gap-2 text-sm text-gray-500 bg-white/50 backdrop-blur-sm px-4 py-2 rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Tip: Click Edit Page to customize your sales page HTML
                </div>
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
            background: #000;
            border-radius: 24px;
            padding: 12px 0;
        }
        
        .mobile-mode iframe {
            border-radius: 20px;
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
        
        btnDesktop.addEventListener('click', function() {
            iframeContainer.classList.remove('mobile-mode');
            iframeContainer.classList.add('desktop-mode');
            
            btnDesktop.className = 'px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-white/30 text-white backdrop-blur-sm flex items-center gap-2';
            btnMobile.className = 'px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-white/10 text-white/80 hover:bg-white/20 flex items-center gap-2';
            
            frameSizeLabel.innerText = 'Desktop View';
        });
        
        btnMobile.addEventListener('click', function() {
            iframeContainer.classList.remove('desktop-mode');
            iframeContainer.classList.add('mobile-mode');
            
            btnMobile.className = 'px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-white/30 text-white backdrop-blur-sm flex items-center gap-2';
            btnDesktop.className = 'px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 bg-white/10 text-white/80 hover:bg-white/20 flex items-center gap-2';
            
            frameSizeLabel.innerText = 'Mobile View (375px)';
        });
        
        refreshBtn.addEventListener('click', function() {
            const currentSrc = previewFrame.src;
            previewFrame.src = '';
            setTimeout(() => {
                previewFrame.src = currentSrc;
            }, 100);
        });
    </script>
</x-app-layout>