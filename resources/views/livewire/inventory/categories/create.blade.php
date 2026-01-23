<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('admin.inventory.categories.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Create New Category') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Add a category to organize inventory items.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">{{ __('Name') }}</label>
                        <input wire:model="name" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="{{ __('e.g., Electronics, Furniture, Lab Equipment...') }}" />
                        @error('name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">{{ __('Color') }}</label>
                        <div class="flex items-center gap-4">
                            <input wire:model="color" type="color" class="h-14 w-24 border-2 border-gray-300 dark:border-gray-600 rounded-xl shadow-sm cursor-pointer p-1" />
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Choose a color to visually identify this category.') }}</p>
                            </div>
                        </div>
                        @error('color') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-white mb-2">{{ __('Description') }}</label>
                        <textarea wire:model="description" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="{{ __('Describe what items belong in this category...') }}"></textarea>
                        @error('description') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.inventory.categories.index') }}" class="mr-6 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Save Category') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
