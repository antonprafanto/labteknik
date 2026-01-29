<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 dark:border-gray-700 p-8">
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">{{ __('Scan QR Code') }}</h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Arahkan kamera Anda ke kode QR barang untuk melihat detailnya.') }}</p>
            </div>

            <div class="max-w-md mx-auto">
                <div class="relative rounded-xl overflow-hidden shadow-lg border-2 border-indigo-200 dark:border-indigo-800">
                    <div id="reader" class="w-full bg-gray-50 dark:bg-gray-900"></div>
                    <!-- Decorative scanning overlay line -->
                    <div class="absolute inset-0 pointer-events-none border-2 border-indigo-500 rounded-xl opacity-50"></div>
                </div>
                
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="px-3 bg-white dark:bg-gray-800 text-sm text-gray-500 dark:text-gray-400 font-medium">
                                {{ __('Atau masukkan kode manual') }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <div class="flex-grow">
                            <label for="scannedCode" class="sr-only">{{ __('Kode Barang') }}</label>
                            <input type="text" id="scannedCode" wire:model.live="scannedCode" 
                                class="w-full border-gray-200 dark:border-gray-600 dark:bg-gray-900 text-gray-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm text-sm py-3" 
                                placeholder="Contoh: INV-2024-001">
                        </div>
                        <button wire:click="handleScan($wire.scannedCode)" 
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            {{ __('Cari') }}
                            <svg class="ml-2 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                    @if($errorMessage)
                        <div class="mt-4 p-4 rounded-lg bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-300">{{ __('Error') }}</h3>
                                    <div class="mt-1 text-sm text-red-700 dark:text-red-400">
                                        <p>{{ $errorMessage }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const html5QrCode = new Html5Qrcode("reader");
            const config = { fps: 10, qrbox: { width: 250, height: 250 } };
            
            html5QrCode.start({ facingMode: "environment" }, config, (decodedText, decodedResult) => {
                // Handle on success condition with the decoded message.
                console.log(`Scan result: ${decodedText}`, decodedResult);
                @this.handleScan(decodedText);
                
                // Stop scanning after success
                html5QrCode.stop().then((ignore) => {
                    // QR Code scanning is stopped.
                }).catch((err) => {
                    // Stop failed, handle it.
                });
            },
            (errorMessage) => {
                // parse error, ignore it.
            })
            .catch((err) => {
                // Start failed, handle it.
            });
        });
    </script>
</div>
