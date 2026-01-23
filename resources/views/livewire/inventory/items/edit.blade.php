<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('admin.inventory.items.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Edit Inventory Item') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Update item details and status.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <!-- Basic Information Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Basic Information') }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Name') }} <span class="text-red-500">*</span></label>
                            <input wire:model="name" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Category') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="category_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="" class="dark:bg-gray-900">{{ __('Select Category') }}</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" class="dark:bg-gray-900">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('category_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Brand') }}</label>
                            <input wire:model="brand" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('brand') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Model') }}</label>
                            <input wire:model="model" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('model') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Status & Location Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ __('Status & Location') }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Laboratory') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="laboratory_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="" class="dark:bg-gray-900">{{ __('Select Laboratory') }}</option>
                                    @foreach($laboratories as $lab)
                                        <option value="{{ $lab->id }}" class="dark:bg-gray-900">{{ $lab->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('laboratory_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Condition') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="condition" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="good" class="dark:bg-gray-900">{{ __('Good') }}</option>
                                    <option value="fair" class="dark:bg-gray-900">{{ __('Fair') }}</option>
                                    <option value="poor" class="dark:bg-gray-900">{{ __('Poor') }}</option>
                                    <option value="damaged" class="dark:bg-gray-900">{{ __('Damaged') }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('condition') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Status') }} <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select wire:model="status" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                    <option value="available" class="dark:bg-gray-900">{{ __('Available') }}</option>
                                    <option value="borrowed" class="dark:bg-gray-900">{{ __('Borrowed') }}</option>
                                    <option value="maintenance" class="dark:bg-gray-900">{{ __('Maintenance') }}</option>
                                    <option value="damaged" class="dark:bg-gray-900">{{ __('Damaged') }}</option>
                                    <option value="lost" class="dark:bg-gray-900">{{ __('Lost') }}</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </div>
                            @error('status') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Purchase Year') }}</label>
                            <input wire:model="purchase_year" type="number" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                            @error('purchase_year') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Image') }}</label>
                            <input wire:model="image" type="file" class="w-full px-3 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 file:transition-colors" />
                             @if($current_image)
                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ __('Current') }}: <a href="{{ asset('storage/' . $current_image) }}" target="_blank" class="ml-1 text-indigo-600 dark:text-indigo-400 hover:underline font-medium">{{ __('View') }}</a>
                                </div>
                            @endif
                            @error('image') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8 space-y-2">
                    <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Description') }}</label>
                    <textarea wire:model="description" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium"></textarea>
                    @error('description') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.inventory.items.index') }}" class="mr-6 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Update Item') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
