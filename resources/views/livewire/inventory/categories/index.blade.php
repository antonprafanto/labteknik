<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ __('Inventory Categories') }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Manage item categories for organization.') }}</p>
                    </div>
                    <a href="{{ route('admin.inventory.categories.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        {{ __('Add New Category') }}
                    </a>
                </div>

                <!-- Search -->
                <div class="mt-4">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="{{ __('Search categories...') }}" class="w-full px-4 py-2 border-gray-200 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm placeholder-gray-400">
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead class="bg-gray-50/50 dark:bg-gray-900/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Description') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Color') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3" style="background-color: {{ $category->color ?? '#6366f1' }}20">
                                        <svg class="w-4 h-4" style="color: {{ $category->color ?? '#6366f1' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($category->description, 50) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($category->color)
                                    <div class="flex items-center">
                                        <span class="inline-block w-6 h-6 rounded-lg border border-gray-200 dark:border-gray-600" style="background-color: {{ $category->color }}"></span>
                                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400 font-mono">{{ $category->color }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.inventory.categories.edit', $category) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    {{ __('Edit') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <p class="text-gray-500 dark:text-gray-400 font-medium">{{ __('No categories found') }}</p>
                                    <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">{{ __('Create your first category to organize inventory items.') }}</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
            <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                {{ $categories->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
