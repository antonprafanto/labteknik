<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('schedules.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Create New Schedule') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Set up a new practicum session.') }}</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="save" class="p-8 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Laboratory -->
                    <div>
                        <label for="laboratory_id" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Laboratory') }}</label>
                        <select id="laboratory_id" wire:model="laboratory_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                            <option value="">{{ __('Select Laboratory') }}</option>
                            @foreach($laboratories as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                            @endforeach
                        </select>
                        @error('laboratory_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Nama Peminjam -->
                    <div>
                        <label for="lecturer_id" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Nama Peminjam') }}</label>
                        <select id="lecturer_id" wire:model="lecturer_id" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                            <option value="">{{ __('Pilih Peminjam') }}</option>
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}">{{ $lecturer->name }}</option>
                            @endforeach
                        </select>
                        @error('lecturer_id') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Course Name -->
                    <div>
                        <label for="course_name" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Course Name') }}</label>
                        <input type="text" id="course_name" wire:model="course_name" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                        @error('course_name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Class Name -->
                    <div>
                        <label for="class_name" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Class Name') }}</label>
                        <input type="text" id="class_name" wire:model="class_name" placeholder="{{ __('e.g. A, B, Reguler') }}" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium">
                        @error('class_name') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="schedule_date" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Date') }}</label>
                        <input type="date" id="schedule_date" wire:model="schedule_date" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                        @error('schedule_date') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Participants -->
                    <div>
                        <label for="participants" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Number of Participants') }}</label>
                        <input type="number" id="participants" wire:model="participants" min="1" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                        @error('participants') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Start Time') }}</label>
                        <input type="time" id="start_time" wire:model="start_time" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                        @error('start_time') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('End Time') }}</label>
                        <input type="time" id="end_time" wire:model="end_time" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium">
                        @error('end_time') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Notes -->
                <div class="mt-8">
                    <label for="notes" class="block font-bold text-sm text-gray-900 dark:text-white mb-2">{{ __('Notes (Optional)') }}</label>
                    <textarea id="notes" wire:model="notes" rows="3" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium"></textarea>
                    @error('notes') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 gap-4">
                    <a href="{{ route('schedules.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 font-bold rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                    <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Save Schedule') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

