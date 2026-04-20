<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Sales Generator | Create High-Converting Sales Pages in Seconds</title>
    <meta name="description" content="Generate professional, high-converting sales pages using AI. Just describe your product and get a complete landing page instantly.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .feature-icon {
            background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);
        }
        .pricing-card {
            transition: all 0.3s ease;
        }
        .pricing-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body class="bg-white">

    <!-- Navbar -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-md z-50 border-b border-gray-100">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 gradient-bg rounded-xl flex items-center justify-center">
                        <span class="text-white text-xl font-bold">AI</span>
                    </div>
                    <span class="font-bold text-xl text-gray-800">Sales<span class="gradient-text">Generator</span></span>
                </div>
                <div class="hidden md:flex gap-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 transition">Features</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-gray-900 transition">How It Works</a>
                    <a href="#pricing" class="text-gray-600 hover:text-gray-900 transition">Pricing</a>
                </div>
                <div>
                    @if(Auth::check())
                        <a href="{{ route('dashboard') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold">
                            Dashboard →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 mr-4">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary text-white px-6 py-2 rounded-lg font-semibold">
                            Get Started
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="container mx-auto">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-block px-4 py-2 bg-indigo-50 rounded-full mb-6">
                    <span class="text-indigo-600 text-sm font-semibold">🚀 AI-Powered Sales Pages</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6">
                    Create High-Converting
                    <span class="gradient-text">Sales Pages</span>
                    in Seconds
                </h1>
                <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                    Just describe your product, and our AI will generate a complete, professional sales page with headline, benefits, features, pricing, and CTA.
                </p>
                <div class="flex gap-4 justify-center flex-wrap">
                    <a href="{{ Auth::check() ? route('sales.create') : route('register') }}" class="btn-primary text-white px-8 py-4 rounded-xl font-semibold text-lg inline-flex items-center gap-2">
                        Start Creating Free
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#how-it-works" class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-xl font-semibold text-lg hover:border-indigo-600 hover:text-indigo-600 transition">
                        Watch Demo
                    </a>
                </div>
            </div>

            <!-- Demo Preview Image -->
            <div class="mt-16 relative">
                <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                <div class="bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                    <div class="bg-gray-800 px-4 py-3 flex items-center gap-2">
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        </div>
                        <div class="flex-1 text-center text-gray-400 text-sm">AI Sales Generator - Live Preview</div>
                    </div>
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-12 text-center">
                        <h2 class="text-3xl font-bold mb-2">EcoBottle Pro</h2>
                        <p class="text-lg opacity-90">Stay Hydrated, Save the Planet</p>
                        <div class="mt-6 inline-block bg-white text-indigo-600 px-6 py-2 rounded-full font-semibold">$34.99</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-50 px-6">
        <div class="container mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-4">Powerful Features</h2>
                <p class="text-xl text-gray-600">Everything you need to create professional sales pages instantly</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">🤖</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">AI-Powered Generation</h3>
                    <p class="text-gray-600">Describe your product, and our AI generates a complete sales page with compelling copy.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">📱</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Responsive Design</h3>
                    <p class="text-gray-600">All sales pages are mobile-friendly and look great on any device.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">💾</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Save & Export</h3>
                    <p class="text-gray-600">Save your sales pages to your account and export them as HTML files.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">✏️</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Edit Any Time</h3>
                    <p class="text-gray-600">Edit generated HTML directly in our built-in editor to customize your page.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">📊</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Preview History</h3>
                    <p class="text-gray-600">Access all your generated sales pages anytime from your history.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 card-hover">
                    <div class="feature-icon w-16 h-16 rounded-2xl flex items-center justify-center mb-6">
                        <span class="text-3xl">⚡</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Quick Templates</h3>
                    <p class="text-gray-600">Use pre-made templates for SaaS, e-commerce, courses, and mobile apps.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 px-6">
        <div class="container mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-4">How It Works</h2>
                <p class="text-xl text-gray-600">Create a sales page in 3 simple steps</p>
            </div>
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">1</div>
                    <h3 class="text-xl font-bold mb-3">Enter Product Details</h3>
                    <p class="text-gray-600">Fill in your product name, description, features, target audience, and price.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">2</div>
                    <h3 class="text-xl font-bold mb-3">AI Generates Page</h3>
                    <p class="text-gray-600">Our AI processes your input and creates a complete, professional sales page.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 gradient-bg rounded-2xl flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6">3</div>
                    <h3 class="text-xl font-bold mb-3">Preview & Export</h3>
                    <p class="text-gray-600">Preview your page, make edits if needed, and export as HTML to use anywhere.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Form -->
    <section class="py-20 bg-gray-50 px-6">
        <div class="container mx-auto max-w-4xl">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="gradient-bg text-white p-8 text-center">
                    <h3 class="text-2xl font-bold mb-2">Ready to Try?</h3>
                    <p class="opacity-90">See how it works with a live demo</p>
                </div>
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                            <input type="text" id="demoName" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g., EcoBottle Pro">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price (USD)</label>
                            <input type="number" id="demoPrice" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="29.99">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="demoDesc" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Describe your product..."></textarea>
                        </div>
                    </div>
                    <div class="mt-6 text-center">
                        <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-3 rounded-xl font-semibold inline-block">
                            Sign Up to Generate →
                        </a>
                        <p class="text-sm text-gray-500 mt-4">Free account required to generate sales pages</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 px-6">
        <div class="container mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-4xl font-bold mb-4">Simple Pricing</h2>
                <p class="text-xl text-gray-600">Start for free, upgrade when you need more</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl p-8 border border-gray-200 pricing-card">
                    <h3 class="text-xl font-bold mb-2">Free</h3>
                    <div class="text-4xl font-bold mb-4">$0</div>
                    <p class="text-gray-600 mb-6">Perfect for trying out</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2">✅ Up to 10 generations</li>
                        <li class="flex items-center gap-2">✅ Basic templates</li>
                        <li class="flex items-center gap-2">✅ Export HTML</li>
                        <li class="flex items-center gap-2">✅ 7-day history</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center border border-indigo-600 text-indigo-600 rounded-lg py-2 font-semibold hover:bg-indigo-50 transition">
                        Get Started
                    </a>
                </div>
                <div class="bg-white rounded-2xl p-8 border-2 border-indigo-600 pricing-card shadow-xl">
                    <div class="inline-block px-3 py-1 bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-full mb-4">POPULAR</div>
                    <h3 class="text-xl font-bold mb-2">Pro</h3>
                    <div class="text-4xl font-bold mb-4">$19<span class="text-lg text-gray-500">/mo</span></div>
                    <p class="text-gray-600 mb-6">For professionals</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2">✅ Unlimited generations</li>
                        <li class="flex items-center gap-2">✅ All templates</li>
                        <li class="flex items-center gap-2">✅ Export HTML + CSS</li>
                        <li class="flex items-center gap-2">✅ Unlimited history</li>
                        <li class="flex items-center gap-2">✅ Priority support</li>
                    </ul>
                    <a href="{{ route('register') }}" class="block text-center btn-primary text-white rounded-lg py-2 font-semibold">
                        Start Free Trial
                    </a>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-gray-200 pricing-card">
                    <h3 class="text-xl font-bold mb-2">Enterprise</h3>
                    <div class="text-4xl font-bold mb-4">Custom</div>
                    <p class="text-gray-600 mb-6">For large teams</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-2">✅ Everything in Pro</li>
                        <li class="flex items-center gap-2">✅ API access</li>
                        <li class="flex items-center gap-2">✅ Custom branding</li>
                        <li class="flex items-center gap-2">✅ Dedicated support</li>
                        <li class="flex items-center gap-2">✅ Team accounts</li>
                    </ul>
                    <a href="#" class="block text-center border border-gray-300 text-gray-700 rounded-lg py-2 font-semibold hover:border-indigo-600 hover:text-indigo-600 transition">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg px-6">
        <div class="container mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-4">Start Creating Sales Pages Today</h2>
            <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
                Join thousands of marketers and entrepreneurs who use AI Sales Generator to create high-converting landing pages.
            </p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-xl transition">
                Get Started for Free →
            </a>
            <p class="mt-4 text-sm opacity-75">No credit card required • Free forever plan</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-bold">AI</span>
                        </div>
                        <span class="font-bold text-white">SalesGenerator</span>
                    </div>
                    <p class="text-sm">Create professional sales pages with AI in seconds.</p>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Product</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#pricing" class="hover:text-white transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white transition">API</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">About</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                <p>&copy; 2026 AI Sales Generator. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>