<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('admin.laboratories.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Create New Laboratory') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Set up a new laboratory facility.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Name') }} <span class="text-red-500">*</span></label>
                        <input wire:model="name" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="Laboratory Name" />
                        @error('name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Location') }} <span class="text-red-500">*</span></label>
                        <input wire:model="location" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="Building / Floor" />
                        @error('location') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Room Number') }}</label>
                        <input wire:model="room_number" type="text" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="e.g. 101" />
                        @error('room_number') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Capacity (People)') }}</label>
                        <input wire:model="capacity" type="number" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                        @error('capacity') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Area (m²)') }}</label>
                        <input wire:model="area" type="number" step="0.01" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                        @error('area') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Head of Lab') }}</label>
                        <div class="relative">
                            <select wire:model="head_lab_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                <option value="" class="dark:bg-gray-900">{{ __('Select Head of Lab') }}</option>
                                @foreach($heads as $head)
                                    <option value="{{ $head->id }}" class="dark:bg-gray-900">{{ $head->name }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        @error('head_lab_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Status') }}</label>
                        <div class="relative">
                            <select wire:model="status" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 appearance-none font-medium">
                                <option value="aktif" class="dark:bg-gray-900">{{ __('Active') }}</option>
                                <option value="maintenance" class="dark:bg-gray-900">{{ __('Maintenance') }}</option>
                                <option value="tidak_aktif" class="dark:bg-gray-900">{{ __('Inactive') }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-900 dark:text-white">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </div>
                        @error('status') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Floor Plan') }}</label>
                        <input wire:model="floor_plan" type="file" class="w-full px-3 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 file:transition-colors" />
                        @error('floor_plan') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-8 space-y-2">
                    <label class="block text-sm font-bold text-gray-900 dark:text-white">{{ __('Description') }}</label>
                    <textarea wire:model="description" rows="4" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" placeholder="Laboratory details..."></textarea>
                    @error('description') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end mt-10 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.laboratories.index') }}" class="mr-6 px-6 py-3 text-sm font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Save Laboratory') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

