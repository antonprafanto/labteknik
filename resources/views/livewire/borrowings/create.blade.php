<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-8 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div class="flex items-center">
                    <a href="{{ route('borrowings.index') }}" class="mr-6 p-3 rounded-xl bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 border border-gray-200 dark:border-gray-600 transition-all duration-200 group">
                        <svg class="w-6 h-6 text-gray-900 dark:text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Create Borrowing Request') }}</h2>
                        <p class="text-base text-gray-700 dark:text-gray-300 mt-2 font-medium">{{ __('Fill in the details and select items to borrow.') }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white dark:bg-gray-800">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Request Form -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-8 border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            {{ __('Request Details') }}
                        </h3>
                        
                        <form wire:submit.prevent="save" class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('Borrow Date') }}</label>
                                    <input wire:model="borrow_date" type="date" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                                    @error('borrow_date') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('Return Date') }}</label>
                                    <input wire:model="return_date" type="date" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium" />
                                    @error('return_date') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('Purpose') }}</label>
                                <textarea wire:model="purpose" rows="4" placeholder="{{ __('Describe the purpose of borrowing...') }}" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium"></textarea>
                                @error('purpose') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('Participants (Optional)') }}</label>
                                <input wire:model="participants" type="number" min="1" placeholder="0" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                                @error('participants') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('No. WhatsApp') }} <span class="text-red-500">*</span></label>
                                    <input wire:model="phone" type="text" placeholder="{{ __('08xxxxxxxxxx') }}" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                                    @error('phone') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('Alamat Tempat Tinggal') }} <span class="text-red-500">*</span></label>
                                    <input wire:model="address" type="text" placeholder="{{ __('Alamat lengkap...') }}" class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 placeholder-gray-400 font-medium" />
                                    @error('address') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Proof Document Upload -->
                            <div class="space-y-2">
                                <label class="block font-bold text-sm text-gray-900 dark:text-white">{{ __('Bukti Surat Peminjaman') }} <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input wire:model="proof_document" type="file" accept=".pdf" id="proof_document" class="hidden" />
                                    <label for="proof_document" class="flex items-center justify-center w-full px-4 py-4 bg-white border-2 border-dashed border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-700 dark:text-gray-300 rounded-xl cursor-pointer hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all duration-200">
                                        <div wire:loading.remove wire:target="proof_document" class="flex flex-col items-center">
                                            @if($proof_document)
                                                <svg class="w-8 h-8 text-emerald-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="font-medium text-emerald-600 dark:text-emerald-400">{{ $proof_document->getClientOriginalName() }}</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($proof_document->getSize() / 1024, 1) }} KB - Klik untuk ganti file</span>
                                            @else
                                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                                <span class="font-medium">Klik untuk upload file PDF</span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maksimal 2MB</span>
                                            @endif
                                        </div>
                                        <div wire:loading wire:target="proof_document" class="flex flex-col items-center">
                                            <svg class="animate-spin w-8 h-8 text-indigo-500 mb-2" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span class="font-medium text-indigo-600">Mengupload...</span>
                                        </div>
                                    </label>
                                </div>
                                @error('proof_document') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-1 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Selected Items List -->
                            <div>
                                <h4 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center text-lg">
                                    <span class="bg-indigo-100 dark:bg-indigo-900/50 text-indigo-700 dark:text-indigo-300 py-1 px-3 rounded-lg text-sm mr-3 border border-indigo-200 dark:border-indigo-700">{{ count($selectedItems) }}</span>
                                    {{ __('Selected Items') }}
                                </h4>
                                @if(count($selectedItems) > 0)
                                    <ul class="bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl divide-y-2 divide-gray-100 dark:divide-gray-700 overflow-hidden shadow-sm">
                                        @foreach($selectedItems as $index => $item)
                                            <li class="p-4 flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors group">
                                                <div>
                                                    <div class="font-bold text-gray-900 dark:text-white text-base">{{ $item['name'] }}</div>
                                                    <div class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mt-1">{{ __('Available') }}: <span class="text-emerald-600 dark:text-emerald-400">{{ $item['available'] }}</span></div>
                                                </div>
                                                <div class="flex items-center gap-3">
                                                    <input type="number" wire:model="selectedItems.{{ $index }}.quantity" min="1" max="{{ $item['available'] }}" class="w-24 px-3 py-2 border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white rounded-lg text-center font-bold focus:border-indigo-500 focus:ring-indigo-500 transition-all">
                                                    <button type="button" wire:click="removeItem({{ $index }})" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors border border-transparent hover:border-red-200 dark:hover:border-red-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center py-10 bg-white dark:bg-gray-800 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-900 dark:text-white font-bold text-base">{{ __('No items selected') }}</p>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ __('Select items from the right panel to proceed') }}</p>
                                    </div>
                                @endif
                                @error('selectedItems') <span class="flex items-center text-red-600 dark:text-red-400 text-sm mt-2 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Disclaimer -->
                            <div class="bg-amber-50 dark:bg-amber-900/20 border-2 border-amber-200 dark:border-amber-800 rounded-xl p-5 mb-6">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="text-sm font-bold text-amber-800 dark:text-amber-300 mb-2">⚠️ PERHATIAN - Syarat & Ketentuan Peminjaman</h4>
                                        <div class="text-xs text-amber-700 dark:text-amber-400 space-y-2">
                                            <p>Dengan mengajukan permohonan peminjaman ini, Anda <strong>menyatakan setuju</strong> dan <strong>bertanggung jawab penuh</strong> atas hal-hal berikut:</p>
                                            <ul class="list-disc list-inside space-y-1 ml-2">
                                                <li><strong>Kerusakan:</strong> Segala bentuk kerusakan yang terjadi pada barang/peralatan selama masa peminjaman akan menjadi <strong>tanggung jawab peminjam</strong> sepenuhnya.</li>
                                                <li><strong>Kehilangan:</strong> Jika barang hilang atau tidak dapat dikembalikan, peminjam <strong>wajib mengganti</strong> dengan barang yang sama atau senilai dengan harga barang tersebut.</li>
                                                <li><strong>Perawatan:</strong> Peminjam wajib <strong>menjaga dan merawat</strong> barang dengan baik selama masa peminjaman.</li>
                                                <li><strong>Pengembalian:</strong> Barang harus dikembalikan dalam <strong>kondisi baik</strong> dan <strong>tepat waktu</strong> sesuai tanggal yang disepakati.</li>
                                                <li><strong>Keterlambatan:</strong> Keterlambatan pengembalian dapat dikenakan <strong>sanksi administratif</strong> sesuai peraturan yang berlaku.</li>
                                                <li><strong>Penggunaan:</strong> Barang hanya boleh digunakan sesuai dengan <strong>tujuan peminjaman</strong> yang tercantum.</li>
                                            </ul>
                                            <p class="mt-3 font-semibold border-t border-amber-300 dark:border-amber-700 pt-2">📋 Peminjam dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan di atas.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <a href="{{ route('borrowings.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 font-bold rounded-xl transition-all duration-200">{{ __('Cancel') }}</a>
                                <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    {{ __('Submit Request') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Item Selection -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-2xl p-8 border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center mb-6">
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                </svg>
                            </div>
                            {{ __('Add Items') }}
                        </h3>
                        
                        <div class="mb-6">
                            <input type="text" 
                                   placeholder="{{ __('Search available items...') }}"
                                   class="w-full px-4 py-3 bg-white border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-gray-900 dark:text-white rounded-xl focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all duration-200 font-medium placeholder-gray-400"
                                   wire:model.live.debounce.300ms="search">
                        </div>

                        <div class="overflow-y-auto h-[450px] bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 rounded-xl shadow-inner custom-scrollbar">
                            <ul class="divide-y-2 divide-gray-100 dark:divide-gray-700">
                                @foreach($availableItems as $item)
                                    <li class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 flex justify-between items-center transition-colors group">
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white text-base">{{ $item->name }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-2">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-medium">
                                                    {{ $item->code }}
                                                </span>
                                                <span class="text-gray-300 dark:text-gray-600">•</span>
                                                <span class="text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wide text-[10px]">{{ __('Stock') }}: {{ $item->available_quantity }}</span>
                                            </div>
                                        </div>
                                        <button type="button" wire:click="addItem({{ $item->id }})" class="inline-flex items-center px-4 py-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 border border-indigo-200 dark:border-indigo-700 rounded-lg text-sm font-bold transition-all transform active:scale-95">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                            </svg>
                                            {{ __('Add') }}
                                        </button>
                                    </li>
                                @endforeach
                                @if($availableItems->isEmpty())
                                    <li class="p-10 text-center flex flex-col items-center justify-center h-full">
                                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-gray-900 dark:text-white font-bold">{{ __('No available items found') }}</p>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ __('Try adjusting your search terms') }}</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

