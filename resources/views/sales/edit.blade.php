<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Edit Sales Page
                    </h2>
                    <p class="text-sm text-gray-500">{{ $salesPage->product_name }}</p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('sales.preview', $salesPage) }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200 shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Preview
                </a>
                <button onclick="regenerateFullPage()"
                    class="bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white px-4 py-2 rounded-lg transition-all duration-200 shadow-md flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Regenerate All
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-white font-semibold">Section Editor</h3>
                                <p class="text-indigo-100 text-sm">Edit HTML or regenerate individual sections</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="mb-4 flex flex-wrap gap-2 border-b border-gray-200 pb-4">
                            @foreach(['headline', 'subheadline', 'hero', 'description', 'benefits', 'features', 'testimonial', 'pricing', 'cta'] as $section)
                            <button onclick="regenerateSection('{{ $section }}')" 
                                data-section="{{ $section }}"
                                class="section-btn bg-gray-100 hover:bg-indigo-100 text-gray-700 hover:text-indigo-700 px-3 py-1.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                {{ ucfirst($section) }}
                            </button>
                            @endforeach
                        </div>
                        
                        <form method="POST" action="{{ route('sales.update', $salesPage) }}" id="editForm">
                            @csrf
                            @method('PUT')
                            <textarea name="generated_output" id="htmlEditor" rows="18" 
                                class="w-full rounded-xl border-gray-200 font-mono text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm"
                                style="font-family: 'Monaco', 'Courier New', monospace;">{{ $salesPage->generated_output }}</textarea>
                            <div class="flex justify-end gap-3 mt-4">
                                <button type="submit" 
                                    class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-6 py-2.5 rounded-lg transition-all duration-200 shadow-md flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gray-800 px-4 py-3 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span class="text-gray-300 text-sm">Live Preview</span>
                        </div>
                        <button onclick="refreshPreview()" class="text-gray-400 hover:text-white transition-all duration-200 p-1.5 rounded-lg hover:bg-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-0 h-[600px] overflow-auto bg-gray-100">
                        <iframe id="livePreview" class="w-full h-full border-0 bg-white"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="toast" class="fixed bottom-6 right-6 transform transition-all duration-300 translate-x-full opacity-0 z-50">
        <div class="flex items-center gap-3 bg-gray-900 text-white px-5 py-3 rounded-xl shadow-2xl">
            <svg id="toastIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span id="toastMessage"></span>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-all duration-200">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-200 scale-95">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Confirm Action</h3>
                        <p class="text-sm text-gray-500" id="modalMessage"></p>
                    </div>
                </div>
                <div class="flex justify-end gap-3">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                        Cancel
                    </button>
                    <button id="modalConfirmBtn" class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white rounded-lg transition shadow-md">
                        Confirm
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let pendingAction = null;

        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toastMessage');
            const toastIcon = document.getElementById('toastIcon');
            
            toastMessage.textContent = message;
            
            if (isError) {
                toastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                toastIcon.parentElement.parentElement.classList.add('bg-red-600');
                setTimeout(() => {
                    toastIcon.parentElement.parentElement.classList.remove('bg-red-600');
                }, 3000);
            } else {
                toastIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                toastIcon.parentElement.parentElement.classList.remove('bg-red-600');
            }
            
            toast.classList.remove('translate-x-full', 'opacity-0');
            toast.classList.add('translate-x-0', 'opacity-100');
            
            setTimeout(() => {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
            }, 3000);
        }

        function showModal(title, message, onConfirm) {
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalMessage').textContent = message;
            document.getElementById('modal').classList.remove('hidden');
            pendingAction = onConfirm;
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            pendingAction = null;
        }

        document.getElementById('modalConfirmBtn').addEventListener('click', () => {
            if (pendingAction) {
                pendingAction();
                closeModal();
            }
        });

        const textarea = document.getElementById('htmlEditor');
        const iframe = document.getElementById('livePreview');
        
        function updatePreview() {
            const content = textarea.value;
            iframe.srcdoc = content;
        }
        
        function refreshPreview() {
            updatePreview();
            showToast('Preview refreshed!');
        }
        
        textarea.addEventListener('input', updatePreview);
        updatePreview();

        async function regenerateSection(section) {
            showModal(
                'Regenerate Section',
                `Regenerate the ${section} section with AI? This will replace only that section.`,
                async () => {
                    const btn = document.querySelector(`[data-section="${section}"]`);
                    const originalHTML = btn.innerHTML;
                    
                    btn.innerHTML = `
                        <svg class="w-3.5 h-3.5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Generating...
                    `;
                    btn.disabled = true;

                    try {
                        const response = await fetch('{{ route("sales.regenerate.section", $salesPage) }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ section: section })
                        });

                        const data = await response.json();

                        if (data.success) {
                            textarea.value = data.html;
                            updatePreview();
                            showToast(data.message);
                        } else {
                            showToast(data.error || 'Unknown error', true);
                        }
                    } catch (error) {
                        showToast('Network error: ' + error.message, true);
                    } finally {
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                    }
                }
            );
        }

        async function regenerateFullPage() {
            showModal(
                'Regenerate Entire Page',
                '⚠️ Regenerate entire page with AI? This will overwrite all your changes.',
                () => {
                    window.location.href = '{{ route("sales.regenerate", $salesPage) }}';
                }
            );
        }

        document.getElementById('editForm').addEventListener('submit', (e) => {
            showToast('Saving changes...');
        });
    </script>
</x-app-layout>