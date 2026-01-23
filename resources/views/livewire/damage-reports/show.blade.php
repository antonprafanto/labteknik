<div class="py-12">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="flex items-center">
                    <a href="{{ route('damage-reports.index') }}" class="mr-4 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ __('Damage Report Details') }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('View and manage damage report information.') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Report Info -->
                    <div class="space-y-6">
                        <!-- Item Information Card -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center mb-4">
                                <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                </svg>
                                {{ __('Item Information') }}
                            </h3>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Name') }}</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $report->inventoryItem->name }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Code') }}</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $report->inventoryItem->code }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Brand') }}</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $report->inventoryItem->brand }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Location') }}</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $report->inventoryItem->laboratory->name ?? 'N/A' }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Report Details Card -->
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center mb-4">
                                <svg class="w-5 h-5 mr-2 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                {{ __('Report Details') }}
                            </h3>
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Reporter') }}</dt>
                                    <dd class="flex items-center">
                                        <div class="w-6 h-6 flex items-center justify-center bg-indigo-100 dark:bg-indigo-900/30 rounded-full mr-2">
                                            <span class="text-xs font-medium text-indigo-700 dark:text-indigo-300">{{ substr($report->reporter->name, 0, 1) }}</span>
                                        </div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $report->reporter->name }}</span>
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Date') }}</dt>
                                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $report->created_at->format('d M Y H:i') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Severity') }}</dt>
                                    <dd>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $report->damage_type === 'ringan' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                            {{ $report->damage_type === 'sedang' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                                            {{ $report->damage_type === 'berat' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                            {{ $report->damage_type === 'total' ? 'bg-gray-800 text-white dark:bg-gray-900 dark:text-gray-100' : '' }}">
                                            {{ ucfirst($report->damage_type) }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm text-gray-500 dark:text-gray-400">{{ __('Status') }}</dt>
                                    <dd>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $report->status === 'reported' ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400' : '' }}
                                            {{ $report->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                            {{ $report->status === 'completed' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400' : '' }}
                                            {{ $report->status === 'cannot_be_repaired' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                            {{ $report->status === 'cancelled' ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' : '' }}">
                                            {{ ucfirst(str_replace('_', ' ', $report->status)) }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Description') }}</h3>
                            <p class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-100 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-300">{{ $report->description }}</p>
                        </div>

                        @if($report->image_path)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">{{ __('Photo Evidence') }}</h3>
                                <img src="{{ Storage::url($report->image_path) }}" alt="Damage Evidence" class="max-w-full h-auto rounded-xl shadow-md border border-gray-100 dark:border-gray-700">
                            </div>
                        @endif
                    </div>

                    <!-- Right Column - Action/Repair Info -->
                    <div>
                        @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('head_of_lab') || auth()->user()->hasRole('lab_assistant'))
                            <div class="bg-indigo-50 dark:bg-indigo-900/20 p-6 rounded-xl border border-indigo-100 dark:border-indigo-800">
                                <h3 class="text-lg font-bold text-indigo-800 dark:text-indigo-300 flex items-center mb-4">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ __('Update Status / Repair Log') }}
                                </h3>
                                
                                @if (session()->has('message'))
                                    <div class="bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-400 dark:border-emerald-700 text-emerald-700 dark:text-emerald-300 px-4 py-3 rounded-lg mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        {{ session('message') }}
                                    </div>
                                @endif

                                <form wire:submit.prevent="updateStatus">
                                    <div class="space-y-4">
                                        <div>
                                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Status') }}</label>
                                            <select id="status" wire:model="status" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                                                <option value="reported">{{ __('Reported') }}</option>
                                                <option value="in_progress">{{ __('In Progress (Under Repair)') }}</option>
                                                <option value="completed">{{ __('Completed (Repaired)') }}</option>
                                                <option value="cannot_be_repaired">{{ __('Cannot Be Repaired') }}</option>
                                                <option value="cancelled">{{ __('Cancelled') }}</option>
                                            </select>
                                            @error('status') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="repair_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Repair Date') }}</label>
                                            <input type="date" id="repair_date" wire:model="repair_date" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                                            @error('repair_date') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="repair_cost" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Repair Cost (Rp)') }}</label>
                                            <input type="number" id="repair_cost" wire:model="repair_cost" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm">
                                            @error('repair_cost') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label for="repair_notes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('Repair Notes / Technical Analysis') }}</label>
                                            <textarea id="repair_notes" wire:model="repair_notes" rows="4" class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm"></textarea>
                                            @error('repair_notes') <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="flex justify-end pt-2">
                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                {{ __('Update Status') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            @if($report->status !== 'reported')
                                <div class="bg-emerald-50 dark:bg-emerald-900/20 p-6 rounded-xl border border-emerald-100 dark:border-emerald-800">
                                    <h3 class="text-lg font-bold text-emerald-800 dark:text-emerald-300 flex items-center mb-4">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ __('Repair Information') }}
                                    </h3>
                                    <dl class="space-y-3">
                                        <div class="flex justify-between">
                                            <dt class="text-sm text-gray-600 dark:text-gray-400">{{ __('Status') }}</dt>
                                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', $report->status)) }}</dd>
                                        </div>
                                        @if($report->repair_date)
                                            <div class="flex justify-between">
                                                <dt class="text-sm text-gray-600 dark:text-gray-400">{{ __('Repair Date') }}</dt>
                                                <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($report->repair_date)->format('d M Y') }}</dd>
                                            </div>
                                        @endif
                                        @if($report->repair_notes)
                                            <div class="pt-2">
                                                <dt class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ __('Notes') }}</dt>
                                                <dd class="p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-100 dark:border-gray-700 text-sm text-gray-700 dark:text-gray-300">{{ $report->repair_notes }}</dd>
                                            </div>
                                        @endif
                                    </dl>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

