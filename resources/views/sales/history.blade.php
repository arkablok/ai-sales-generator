<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales Page History') }}
            </h2>
            <a href="{{ route('sales.create') }}" 
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                + Create New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Search Form -->
                    <form method="GET" class="mb-6">
                        <div class="flex gap-2">
                            <input type="text" name="search" placeholder="Search by product name..." 
                                value="{{ request('search') }}"
                                class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                🔍 Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('sales.history') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($salesPages->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Target Audience</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($salesPages as $page)
                                    <tr>
                                        <td class="px-6 py-4 font-medium">{{ $page->product_name }}</td>
                                        <td class="px-6 py-4">{{ $page->target_audience }}</td>
                                        <td class="px-6 py-4">${{ number_format($page->price, 2) }}</td>
                                        <td class="px-6 py-4">{{ $page->created_at->format('M d, Y H:i') }}</td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a href="{{ route('sales.preview', $page) }}" 
                                               class="text-blue-600 hover:text-blue-800">👁️ Preview</a>
                                            <form action="{{ route('sales.regenerate', $page) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-yellow-600 hover:text-yellow-800"
                                                    onclick="return confirm('Regenerate this sales page? This will use AI credits.')">
                                                    🔄 Regenerate
                                                </button>
                                            </form>
                                            <form action="{{ route('sales.destroy', $page) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" 
                                                    onclick="return confirm('Delete this sales page permanently?')">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $salesPages->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">No sales pages yet.</p>
                            <a href="{{ route('sales.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
                                Create Your First Sales Page
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>