<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center">
                        <a href="{{ route('admin.inventory.items.index') }}" class="mr-4 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $this->item->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-mono mt-1">{{ $this->item->code }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.inventory.items.edit', $this->item) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('Edit') }}
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Image and QR Code -->
                    <div class="md:col-span-1 flex flex-col items-center space-y-6">
                        @if($this->item->image_path)
                            <img src="{{ asset('storage/' . $this->item->image_path) }}" alt="{{ $this->item->name }}" class="w-full h-auto rounded-xl shadow-lg object-cover border border-gray-100 dark:border-gray-700">
                        @else
                            <div class="w-full h-64 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No Image Available') }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="bg-white dark:bg-gray-900 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col items-center w-full">
                            <img src="{{ $this->qrCodeUrl }}" alt="QR Code" class="mb-3 rounded-lg">
                            <span class="text-sm font-mono font-bold text-gray-900 dark:text-white">{{ $this->item->code }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ __('Scan for tracking') }}</span>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Information Card -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-xl border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Information') }}</h3>
                            </div>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Brand') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->brand ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Model') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->model ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Category') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->category->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Purchase Year') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->purchase_year }}</dd>
                                </div>
                                <div class="md:col-span-2">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Description') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->description ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Status & Location Card -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-xl border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Status & Location') }}</h3>
                            </div>
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Laboratory') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->laboratory->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Location') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $this->item->laboratory->location }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Condition') }}</dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst($this->item->condition) }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Status') }}</dt>
                                    <dd class="mt-1">
                                        @php
                                            $statusClasses = [
                                                'available' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                'borrowed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                                'maintenance' => 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400',
                                                'damaged' => 'bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400',
                                                'lost' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                            ];
                                        @endphp
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$this->item->status] ?? $statusClasses['lost'] }}">
                                            {{ ucfirst($this->item->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('Quantity') }}</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-bold bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                                            {{ $this->item->available_quantity }} / {{ $this->item->quantity }}
                                        </span>
                                        <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">{{ __('Available') }} / {{ __('Total') }}</span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Maintenance & Damage History -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-xl border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Maintenance Logs') }}</h3>
                                </div>
                                @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('head_of_lab') || auth()->user()->hasRole('lab_assistant'))
                                    <button wire:click="openMaintenanceModal" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        {{ __('Add Log') }}
                                    </button>
                                @endif
                            </div>
                            
                            @if($maintenanceLogs->count() > 0)
                                <ul class="space-y-3">
                                    @foreach($maintenanceLogs as $log)
                                        <li class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                            <div class="flex justify-between items-start">
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">{{ ucfirst($log->maintenance_type) }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $log->maintenance_date->format('d M Y') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ Str::limit($log->description, 100) }}</p>
                                            @if($log->next_maintenance_date)
                                                <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ __('Next Due') }}: {{ $log->next_maintenance_date->format('d M Y') }}
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No maintenance logs recorded.') }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Damage Reports -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-xl border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('Damage Reports') }}</h3>
                            </div>
                            
                            @if($damageReports->count() > 0)
                                <ul class="space-y-3">
                                    @foreach($damageReports as $report)
                                        <li class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700">
                                            <div class="flex justify-between items-start">
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800 dark:bg-rose-900/30 dark:text-rose-400">{{ ucfirst($report->damage_type) }} {{ __('Damage') }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $report->created_at->format('d M Y') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ Str::limit($report->description, 100) }}</p>
                                            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('Status') }}: <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $report->status)) }}</span>
                                                @if($report->repair_date)
                                                    | {{ __('Repaired') }}: {{ \Carbon\Carbon::parse($report->repair_date)->format('d M Y') }}
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No damage reports recorded.') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Modal -->
    <x-dialog-modal wire:model.live="showMaintenanceModal">
        <x-slot name="title">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                {{ __('Add Maintenance Log') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <x-label for="maintenance_type" value="{{ __('Type') }}" class="dark:text-gray-300" />
                    <select id="maintenance_type" wire:model="maintenance_type" class="block mt-1 w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                        <option value="routine_check">{{ __('Routine Check') }}</option>
                        <option value="cleaning">{{ __('Cleaning') }}</option>
                        <option value="calibration">{{ __('Calibration') }}</option>
                        <option value="software_update">{{ __('Software Update') }}</option>
                        <option value="part_replacement">{{ __('Part Replacement') }}</option>
                        <option value="other">{{ __('Other') }}</option>
                    </select>
                    <x-input-error for="maintenance_type" class="mt-2" />
                </div>

                <div>
                    <x-label for="description" value="{{ __('Description') }}" class="dark:text-gray-300" />
                    <textarea id="description" wire:model="description" rows="3" class="block mt-1 w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm"></textarea>
                    <x-input-error for="description" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="cost" value="{{ __('Cost (Rp)') }}" class="dark:text-gray-300" />
                        <x-input id="cost" type="number" wire:model="cost" class="block mt-1 w-full dark:bg-gray-900 dark:border-gray-600" />
                        <x-input-error for="cost" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="next_maintenance_date" value="{{ __('Next Maintenance') }}" class="dark:text-gray-300" />
                        <x-input id="next_maintenance_date" type="date" wire:model="next_maintenance_date" class="block mt-1 w-full dark:bg-gray-900 dark:border-gray-600" />
                        <x-input-error for="next_maintenance_date" class="mt-2" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showMaintenanceModal', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ml-3" wire:click="saveMaintenanceLog" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
