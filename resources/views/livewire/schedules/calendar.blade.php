<div class="py-12">
    <style>
        /* Custom Calendar Styles with Dark Mode Support */
        .fc-theme-standard td, .fc-theme-standard th {
            border-color: #cbd5e1 !important;
        }
        .dark .fc-theme-standard td, .dark .fc-theme-standard th {
            border-color: #374151 !important;
        }
        .fc-timegrid-slot {
            border-bottom: 1px solid #e2e8f0 !important;
        }
        .dark .fc-timegrid-slot {
            border-bottom: 1px solid #374151 !important;
        }
        .fc-col-header-cell {
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: 600;
            padding: 8px 0 !important;
        }
        .dark .fc-col-header-cell {
            background-color: #1f2937 !important;
            color: #f9fafb !important;
        }
        .fc-timegrid-axis-cushion, .fc-timegrid-slot-label-cushion {
            color: #1e293b !important;
            font-weight: 600;
        }
        .dark .fc-timegrid-axis-cushion, .dark .fc-timegrid-slot-label-cushion {
            color: #d1d5db !important;
        }
        .fc-day-today {
            background-color: #fffbeb !important;
        }
        .dark .fc-day-today {
            background-color: rgba(245, 158, 11, 0.1) !important;
        }
        .fc-event {
            font-weight: 700;
            border: none !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            color: #ffffff !important;
            border-radius: 6px !important;
        }
        .fc-event-main {
            padding: 4px 6px;
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0,0,0,0.4);
        }
        .fc-event-time, .fc-event-title {
            color: #ffffff !important;
        }
        .fc-button-primary {
            background-color: #4f46e5 !important;
            border-color: #4f46e5 !important;
            text-transform: capitalize;
            border-radius: 8px !important;
        }
        .fc-button-primary:hover {
            background-color: #4338ca !important;
            border-color: #4338ca !important;
        }
        .fc-button-active {
            background-color: #3730a3 !important;
            border-color: #3730a3 !important;
        }
        .fc-toolbar-title {
            font-size: 1.25rem !important;
            font-weight: 700 !important;
        }
        .dark .fc-toolbar-title {
            color: #f9fafb !important;
        }
        .dark .fc-button-primary {
            background-color: #6366f1 !important;
            border-color: #6366f1 !important;
        }
    </style>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ __('Practicum Schedule Calendar') }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('View and manage laboratory schedules visually.') }}</p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <select wire:model.live="laboratory_id" class="border-gray-200 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                            <option value="">{{ __('All Laboratories') }}</option>
                            @foreach($laboratories as $lab)
                                <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                            @endforeach
                        </select>

                        <a href="{{ route('schedules.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            {{ __('Add Schedule') }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div id="calendar" wire:ignore class="bg-white dark:bg-gray-800 rounded-xl"></div>
            </div>
        </div>
    </div>

    <!-- Event Detail Modal -->
    <div x-data="{ open: false, event: {} }" 
         x-on:open-event-modal.window="open = true; event = $event.detail"
         x-show="open" 
         class="fixed inset-0 z-50 overflow-y-auto" 
         style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="open" @click.away="open = false" 
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-gray-700">
                <div class="px-6 py-5">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="event.title"></h3>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span x-text="event.start"></span> - <span x-text="event.end"></span>
                        </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span x-text="event.laboratory"></span>
                        </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span x-text="event.lecturer"></span>
                        </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span x-text="event.participants"></span> {{ __('participants') }}
                        </div>
                        <div class="flex items-center text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Angkatan: <span x-text="event.year_batch"></span>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 px-6 py-4 flex justify-end gap-3">
                    <button @click="open = false" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        {{ __('Close') }}
                    </button>
                    
                    @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('head_of_lab'))
                    <a :href="'/schedules/' + event.id + '/edit'" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('Edit') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('livewire:initialized', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                slotMinTime: '07:00:00',
                slotMaxTime: '18:00:00',
                allDaySlot: false,
                events: @json($events),
                eventClick: function(info) {
                    let event = info.event;
                    let props = event.extendedProps;
                    
                    let startTime = event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    let endTime = event.end ? event.end.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) : '';

                    window.dispatchEvent(new CustomEvent('open-event-modal', {
                        detail: {
                            id: event.id,
                            title: event.title,
                            start: startTime,
                            end: endTime,
                            laboratory: props.laboratory,
                            lecturer: props.lecturer,
                            participants: props.participants,
                            year_batch: props.year_batch
                        }
                    }));
                }
            });
            calendar.render();

            Livewire.on('refreshCalendar', (events) => {
                calendar.removeAllEvents();
                calendar.addEventSource(events);
            });
        });
    </script>
</div>

