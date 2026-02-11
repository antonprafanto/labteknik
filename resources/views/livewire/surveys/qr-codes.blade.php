<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">QR Code Survey</h1>
                <p class="text-gray-600 dark:text-gray-400">Generate QR code survey kepuasan per laboratorium</p>
            </div>
            <a href="{{ route('surveys.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-xl transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Lab Selection -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Pilih Laboratorium</h2>
                <div class="space-y-2 max-h-96 overflow-y-auto">
                    @foreach($laboratories as $lab)
                        <button 
                            wire:click="selectLab({{ $lab->id }})"
                            class="w-full text-left px-4 py-3 rounded-xl transition-colors
                                @if($selectedLab && $selectedLab->id === $lab->id)
                                    bg-indigo-600 text-white
                                @else
                                    bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700
                                @endif">
                            <div class="font-medium">{{ $lab->name }}</div>
                            <div class="text-sm opacity-70">{{ $lab->code ?? 'No code' }}</div>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- QR Code Display -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                @if($selectedLab && $qrCode)
                    <div class="text-center">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $selectedLab->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Scan QR untuk isi survey kepuasan</p>
                        
                        <div class="bg-white p-6 rounded-xl inline-block shadow-lg mb-6" id="qr-container">
                            {!! $qrCode !!}
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 mb-6">
                            <p class="text-xs text-gray-500 dark:text-gray-400 break-all">
                                {{ route('surveys.create', ['laboratory' => $selectedLab->id]) }}
                            </p>
                        </div>

                        <button onclick="printQR()" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Print QR Code
                        </button>
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h2M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Pilih laboratorium untuk generate QR code</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function printQR() {
    const qrContainer = document.getElementById('qr-container');
    const labName = '{{ $selectedLab ? $selectedLab->name : '' }}';
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>QR Code Survey - ${labName}</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    text-align: center; 
                    padding: 40px;
                }
                h1 { margin-bottom: 10px; }
                h2 { margin-bottom: 20px; color: #666; }
                .qr { margin: 20px auto; }
                .instructions { 
                    margin-top: 20px; 
                    padding: 15px; 
                    background: #f5f5f5; 
                    border-radius: 8px;
                    text-align: left;
                }
                .instructions p { margin: 5px 0; }
            </style>
        </head>
        <body>
            <h1>${labName}</h1>
            <h2>Survey Kepuasan Laboratorium</h2>
            <div class="qr">${qrContainer.innerHTML}</div>
            <div class="instructions">
                <p><strong>Cara Mengisi Survey:</strong></p>
                <p>1. Buka kamera HP Anda</p>
                <p>2. Arahkan ke QR Code</p>
                <p>3. Isi survey kepuasan laboratorium</p>
                <p>4. Masukan Anda sangat berharga!</p>
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}
</script>
@endpush
