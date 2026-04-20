<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Preview Sales Page') }} - {{ $salesPage->product_name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('sales.export', $salesPage) }}" 
                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    📥 Download HTML
                </a>
                <a href="{{ route('sales.history') }}" 
                   class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    ← Back to History
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-0">
                    @if(session('success'))
                        <div class="m-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <!-- Live Preview -->
                    <iframe srcdoc="{{ htmlspecialchars($salesPage->generated_output) }}" 
                            class="w-full h-[800px] border-0"
                            title="Sales Page Preview">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>