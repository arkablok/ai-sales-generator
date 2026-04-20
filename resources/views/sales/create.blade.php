<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Sales Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4">
                    <h3 class="text-white font-semibold text-lg">📝 Product Information</h3>
                    <p class="text-indigo-100 text-sm">Fill in the details below and AI will generate a professional sales page</p>
                </div>
                
                <div class="p-6">
                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sales.generate') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                            <input type="text" name="product_name" required 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('product_name') }}" placeholder="e.g., SmartWatch Pro X">
                            @error('product_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Product Description *</label>
                            <textarea name="description" rows="4" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Describe your product in detail...">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Features (comma separated) *</label>
                            <input type="text" name="features" required 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('features') }}" placeholder="e.g., Premium Material, Water Resistant, 5-Year Warranty">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Target Audience *</label>
                            <input type="text" name="target_audience" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('target_audience') }}" placeholder="e.g., Fitness enthusiasts, Office workers">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price (USD) *</label>
                            <input type="number" name="price" required step="0.01"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('price') }}" placeholder="99.99">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unique Selling Points (Optional)</label>
                            <textarea name="unique_selling_points" rows="3"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="What makes your product unique?">{{ old('unique_selling_points') }}</textarea>
                        </div>

                        <!-- Quick Templates -->
                        <div class="border-t pt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">⚡ Quick Templates</label>
                            <div class="flex gap-2 flex-wrap">
                                <button type="button" onclick="fillTemplate('saas')" class="text-sm bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 transition">SaaS Product</button>
                                <button type="button" onclick="fillTemplate('ecommerce')" class="text-sm bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 transition">E-commerce</button>
                                <button type="button" onclick="fillTemplate('course')" class="text-sm bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 transition">Online Course</button>
                                <button type="button" onclick="fillTemplate('app')" class="text-sm bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 transition">Mobile App</button>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" id="submitBtn"
                                class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-lg font-semibold">
                                ✨ Generate Sales Page
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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

        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '⏳ Generating with AI...';
        });
    </script>
</x-app-layout>