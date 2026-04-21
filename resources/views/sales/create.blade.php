<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sales Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold text-lg">Product Information</h3>
                            <p class="text-indigo-100 text-sm">Fill in the details below and AI will generate a professional sales page</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="flex-1">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sales.generate') }}" class="space-y-6" id="generateForm">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    Product Name *
                                </span>
                            </label>
                            <input type="text" name="product_name" required 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                value="{{ old('product_name') }}" placeholder="e.g., SmartWatch Pro X">
                            @error('product_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                    Product Description *
                                </span>
                            </label>
                            <textarea name="description" rows="4" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Features (comma separated) *
                                </span>
                            </label>
                            <input type="text" name="features" required 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                value="{{ old('features') }}" placeholder="e.g., Premium Material, Water Resistant, 5-Year Warranty">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    Target Audience *
                                </span>
                            </label>
                            <input type="text" name="target_audience" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                value="{{ old('target_audience') }}" placeholder="e.g., Fitness enthusiasts, Office workers">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Price (USD) *
                                </span>
                            </label>
                            <input type="number" name="price" required step="0.01"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                value="{{ old('price') }}" placeholder="99.99">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    Unique Selling Points (Optional)
                                </span>
                            </label>
                            <textarea name="unique_selling_points" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition"
                                placeholder="What makes your product unique?">{{ old('unique_selling_points') }}</textarea>
                        </div>

                        <div class="border-t pt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Quick Templates
                                </span>
                            </label>
                            <div class="flex gap-2 flex-wrap">
                                <button type="button" onclick="fillTemplate('saas')" 
                                    class="text-sm bg-gray-100 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    SaaS Product
                                </button>
                                <button type="button" onclick="fillTemplate('ecommerce')" 
                                    class="text-sm bg-gray-100 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    E-commerce
                                </button>
                                <button type="button" onclick="fillTemplate('course')" 
                                    class="text-sm bg-gray-100 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    Online Course
                                </button>
                                <button type="button" onclick="fillTemplate('app')" 
                                    class="text-sm bg-gray-100 hover:bg-indigo-50 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-lg transition-all duration-200 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    Mobile App
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" id="submitBtn"
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg font-semibold flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Generate Sales Page
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="loadingOverlay" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center">
                <div class="relative w-24 h-24 mx-auto mb-6">
                    <svg class="w-24 h-24 animate-spin text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span id="progressPercent" class="text-2xl font-bold text-indigo-600">0%</span>
                    </div>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Generating Sales Page</h3>
                <p class="text-gray-500 mb-4">AI is creating your professional sales page...</p>
                <div class="w-full bg-gray-200 rounded-full h-2 mb-4 overflow-hidden">
                    <div id="progressBar" class="bg-gradient-to-r from-indigo-600 to-purple-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                </div>
                <p id="loadingStatus" class="text-sm text-gray-400">Initializing AI...</p>
            </div>
        </div>
    </div>

    <script>
        let progressInterval;

        function fillTemplate(type) {
            const templates = {
                saas: {
                    name: 'ProjectFlow SaaS',
                    desc: 'Project management software for remote teams with AI-powered task assignment and real-time collaboration.',
                    features: 'AI Task Assignment, Real-time Chat, Time Tracking, Reporting Dashboard',
                    audience: 'Remote teams, Project managers, Freelancers',
                    price: '29.99',
                    usp: 'No per-user pricing, unlimited projects, 24/7 support'
                },
                ecommerce: {
                    name: 'EcoBottle',
                    desc: 'Insulated stainless steel water bottle that keeps drinks cold for 24 hours or hot for 12 hours.',
                    features: 'Double-wall insulation, BPA-free, Leak-proof, 5 colors available',
                    audience: 'Health-conscious people, Students, Office workers',
                    price: '34.99',
                    usp: 'Plants 1 tree per purchase, lifetime warranty'
                },
                course: {
                    name: 'Master Digital Marketing',
                    desc: 'Complete online course covering SEO, social media, email marketing, and analytics.',
                    features: '60+ video lessons, Downloadable resources, Certificate, Community access',
                    audience: 'Aspiring marketers, Business owners, Students',
                    price: '199.00',
                    usp: '30-day money back guarantee, lifetime access'
                },
                app: {
                    name: 'FitTrack',
                    desc: 'Fitness tracking app that uses AI to create personalized workout and meal plans.',
                    features: 'Workout plans, Meal tracking, Progress photos, Integration with Apple Health',
                    audience: 'Fitness beginners, Athletes, Weight loss seekers',
                    price: '9.99',
                    usp: '7-day free trial, cancel anytime'
                }
            };
            
            const t = templates[type];
            if(t) {
                document.querySelector('input[name="product_name"]').value = t.name;
                document.querySelector('textarea[name="description"]').value = t.desc;
                document.querySelector('input[name="features"]').value = t.features;
                document.querySelector('input[name="target_audience"]').value = t.audience;
                document.querySelector('input[name="price"]').value = t.price;
                document.querySelector('textarea[name="unique_selling_points"]').value = t.usp;
            }
        }

        function startProgressSimulation() {
            let progress = 0;
            const statusMessages = [
                'Initializing AI...',
                'Analyzing product information...',
                'Generating headline...',
                'Creating product description...',
                'Adding features section...',
                'Generating benefits...',
                'Creating pricing section...',
                'Adding call to action...',
                'Optimizing layout...',
                'Finalizing your sales page...'
            ];
            
            progressInterval = setInterval(() => {
                if (progress < 100) {
                    progress += Math.random() * 15;
                    if (progress > 100) progress = 100;
                    
                    document.getElementById('progressBar').style.width = progress + '%';
                    document.getElementById('progressPercent').textContent = Math.floor(progress) + '%';
                    
                    const statusIndex = Math.floor((progress / 100) * statusMessages.length);
                    if (statusIndex < statusMessages.length) {
                        document.getElementById('loadingStatus').textContent = statusMessages[statusIndex];
                    }
                }
            }, 800);
        }

        document.getElementById('generateForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const overlay = document.getElementById('loadingOverlay');
            const progressBar = document.getElementById('progressBar');
            const progressPercent = document.getElementById('progressPercent');
            
            progressBar.style.width = '0%';
            progressPercent.textContent = '0%';
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            
            startProgressSimulation();
            
            const formData = new FormData(this);
            
            fetch('{{ route("sales.generate") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                clearInterval(progressInterval);
                document.getElementById('progressBar').style.width = '100%';
                document.getElementById('progressPercent').textContent = '100%';
                document.getElementById('loadingStatus').textContent = 'Complete! Redirecting...';
                
                setTimeout(() => {
                    if (data.success) {
                        window.location.href = data.redirect;
                    } else {
                        overlay.classList.add('hidden');
                        alert('Error: ' + (data.error || 'Unknown error'));
                    }
                }, 500);
            })
            .catch(error => {
                clearInterval(progressInterval);
                overlay.classList.add('hidden');
                alert('Network error: ' + error.message);
            });
        });
    </script>
</x-app-layout>