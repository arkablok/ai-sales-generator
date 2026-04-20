<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl mb-8 overflow-hidden">
                <div class="p-8 text-white">
                    <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-indigo-100 mb-6">Create professional sales pages in seconds using AI</p>
                    <a href="{{ route('sales.create') }}" 
                       class="inline-block bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                        🚀 Create New Sales Page
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="text-3xl mb-2">📄</div>
                    <div class="text-2xl font-bold text-gray-800">{{ Auth::user()->salesPages()->count() }}</div>
                    <div class="text-gray-500">Total Sales Pages</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="text-3xl mb-2">⚡</div>
                    <div class="text-2xl font-bold text-gray-800">AI Powered</div>
                    <div class="text-gray-500">Gemini AI Generation</div>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="text-3xl mb-2">💾</div>
                    <div class="text-2xl font-bold text-gray-800">Save & Export</div>
                    <div class="text-gray-500">HTML Download Available</div>
                </div>
            </div>

            <!-- Recent Pages -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="font-semibold text-lg">📋 Recent Sales Pages</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse(Auth::user()->salesPages()->latest()->take(5)->get() as $page)
                    <div class="px-6 py-4 flex justify-between items-center hover:bg-gray-50">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $page->product_name }}</h4>
                            <p class="text-sm text-gray-500">Created: {{ $page->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('sales.preview', $page) }}" class="text-indigo-600 hover:text-indigo-800">👁️ Preview</a>
                            <a href="{{ route('sales.edit', $page) }}" class="text-green-600 hover:text-green-800">✏️ Edit</a>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-8 text-center text-gray-500">
                        No sales pages yet. 
                        <a href="{{ route('sales.create') }}" class="text-indigo-600">Create your first one!</a>
                    </div>
                    @endforelse
                </div>
                @if(Auth::user()->salesPages()->count() > 5)
                <div class="px-6 py-3 bg-gray-50 text-center">
                    <a href="{{ route('sales.history') }}" class="text-indigo-600 hover:underline">View all →</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>