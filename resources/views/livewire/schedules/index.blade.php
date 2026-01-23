<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ __('Practicum Schedules') }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Manage laboratory session schedules.') }}</p>
                    </div>
                    @auth
                        @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('head_of_lab') || auth()->user()->hasRole('lecturer'))
                            <a href="{{ route('schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                {{ __('Add Schedule') }}
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div>
                        <input wire:model.live="search" type="text" placeholder="{{ __('Search Course or Class...') }}" class="w-full px-4 py-2 border-gray-200 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm placeholder-gray-400">
                    </div>
                    <div>
                        <select wire:model.live="selectedLab" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                            <option value="">{{ __('All Laboratories') }}</option>
                            @foreach($laboratories as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <input wire:model.live="dateFilter" type="date" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                    </div>
                </div>
            </div>

            @if (session()->has('message'))
                <div class="mx-6 mt-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100 dark:divide-gray-700">
                    <thead class="bg-gray-50/50 dark:bg-gray-900/50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Date & Time') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Laboratory') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Course Info') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Lecturer') }}</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Status') }}</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($schedules as $schedule)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $schedule->schedule_date->format('D, d M Y') }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $schedule->laboratory->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $schedule->course_name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('Class') }}: {{ $schedule->class_name }} ({{ $schedule->participants }} pax)</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white">{{ $schedule->lecturer->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $schedule->status === 'scheduled' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                        {{ $schedule->status === 'ongoing' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400' : '' }}
                                        {{ $schedule->status === 'completed' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}
                                        {{ $schedule->status === 'cancelled' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}">
                                        {{ __(ucfirst($schedule->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @auth
                                        @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('head_of_lab') || auth()->id() == $schedule->created_by)
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('schedules.edit', $schedule) }}" class="p-2 text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 rounded-lg transition-colors" title="{{ __('Edit') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </a>
                                                <button wire:click="delete({{ $schedule->id }})" wire:confirm="{{ __('Are you sure you want to delete this schedule?') }}" class="p-2 text-red-600 hover:text-red-900 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors" title="{{ __('Delete') }}">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400">{{ __('No schedules found.') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($schedules->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50">
                {{ $schedules->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

