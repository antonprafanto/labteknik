<div class="relative" x-data="{ open: false }" @click.away="open = false" @close.stop="open = false">
    <button @click="open = ! open" class="relative p-2 rounded-lg text-gray-400 dark:text-gray-300 hover:text-gray-500 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
        <span class="sr-only">{{ __('View notifications') }}</span>
        <!-- Heroicon name: outline/bell -->
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        @if($this->unreadCount > 0)
            <span class="absolute top-1 right-1 block h-2 w-2 rounded-full ring-2 ring-white dark:ring-gray-800 bg-red-500"></span>
        @endif
    </button>

    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 mt-2 w-80 rounded-xl shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 dark:ring-gray-700 focus:outline-none z-50 border border-gray-100 dark:border-gray-700"
         style="display: none;">
        
        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">{{ __('Notifikasi') }}</h3>
            @if($this->unreadCount > 0)
                <button wire:click="markAllAsRead" class="text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">{{ __('Tandai semua dibaca') }}</button>
            @endif
        </div>

        <div class="max-h-64 overflow-y-auto">
            @forelse($this->notifications as $notification)
                <div wire:click="markAsRead('{{ $notification->id }}')" class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 cursor-pointer border-b border-gray-100 dark:border-gray-700 transition duration-150 ease-in-out">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            @if($notification->data['type'] ?? '' === 'borrowing_status')
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </span>
                            @elseif($notification->data['type'] ?? '' === 'damage_report')
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-rose-100 dark:bg-rose-900/30 text-rose-500 dark:text-rose-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </span>
                            @elseif($notification->data['type'] ?? '' === 'survey_submitted')
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg {{ ($notification->data['is_low_rating'] ?? false) ? 'bg-orange-100 dark:bg-orange-900/30 text-orange-500 dark:text-orange-400' : 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-500 dark:text-yellow-400' }}">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </span>
                            @else
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </span>
                            @endif
                        </div>
                        <div class="ml-3 w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $notification->data['title'] ?? 'Notification' }}</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($notification->data['message'] ?? '', 60) }}</p>
                            <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center">
                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">{{ __('Tidak ada notifikasi baru.') }}</p>
                </div>
            @endforelse
        </div>
        
        @if($this->unreadCount > 5)
            <div class="block bg-gray-50 dark:bg-gray-700/50 px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase hover:text-gray-700 dark:hover:text-gray-300 cursor-pointer transition-colors border-t border-gray-100 dark:border-gray-700">
                {{ __('Lihat semua notifikasi') }}
            </div>
        @endif
    </div>
</div>
