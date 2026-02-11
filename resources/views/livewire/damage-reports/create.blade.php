<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-red-500 via-orange-500 to-yellow-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('damage-reports.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Report Item Damage') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Report damage or malfunction of laboratory equipment.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Item Dropdown -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="inventory_item_id" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Select Item') }}</label>
                        <select id="inventory_item_id" wire:model="inventory_item_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-red-500 focus:ring-red-500 shadow-sm transition-all duration-200 font-medium">
                            <option value="">{{ __('-- Select Item --') }}</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->code }}) - {{ $item->brand }}</option>
                            @endforeach
                        </select>
                        @error('inventory_item_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-2 font-medium">{{ __('Please select a valid item.') }}</span> @enderror
                    </div>

                    <!-- Damage Type -->
                    <div>
                        <label for="damage_type" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Damage Severity') }}</label>
                        <select id="damage_type" wire:model="damage_type" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-red-500 focus:ring-red-500 shadow-sm transition-all duration-200 font-medium">
                            <option value="">{{ __('Select Severity') }}</option>
                            <option value="ringan">{{ __('Light (Ringan)') }}</option>
                            <option value="sedang">{{ __('Moderate (Sedang)') }}</option>
                            <option value="berat">{{ __('Heavy (Berat)') }}</option>
                            <option value="total">{{ __('Total Loss (Total)') }}</option>
                        </select>
                        @error('damage_type') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Image (Camera) -->
                    <div>
                        <label for="image" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Photo Evidence (Optional)') }}</label>
                        <input type="file" id="image" wire:model="image" accept="image/*" capture="environment" class="w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-red-50 dark:file:bg-red-900/30 file:text-red-700 dark:file:text-red-300 hover:file:bg-red-100 dark:hover:file:bg-red-900/50 file:transition-colors cursor-pointer bg-gray-50 dark:bg-gray-900 rounded-xl border-2 border-gray-300 dark:border-gray-600">
                        @error('image') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                        
                        <div wire:loading wire:target="image" class="text-sm text-gray-500 dark:text-gray-400 mt-2 flex items-center font-medium">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('Uploading...') }}
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="description" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Description of Damage') }}</label>
                        <textarea id="description" wire:model="description" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-red-500 focus:ring-red-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="{{ __('Describe how the damage happened and the current state of the item...') }}"></textarea>
                        @error('description') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 gap-4">
                    <a href="{{ route('damage-reports.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 font-bold rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        {{ __('Submit Report') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

