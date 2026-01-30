<div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tata Tertib Laboratorium</h1>
                <p class="text-gray-600 dark:text-gray-400">Kelola peraturan dan tata tertib laboratorium</p>
            </div>
            <div>
                <a href="{{ route('admin.lab-rules.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Tata Tertib
                </a>
            </div>
        </div>

        <!-- Flash Message -->
        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 rounded-xl">
                {{ session('message') }}
            </div>
        @endif

        <!-- Content -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            @if($rule)
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $rule->title }}</h2>
                        @if($rule->is_active)
                            <span class="px-3 py-1 text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full">Aktif</span>
                        @else
                            <span class="px-3 py-1 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full">Tidak Aktif</span>
                        @endif
                    </div>
                    @if($rule->updater)
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                            Terakhir diperbarui oleh {{ $rule->updater->name }} pada {{ $rule->updated_at->format('d M Y, H:i') }}
                        </p>
                    @endif
                </div>
                <div class="p-6">
                    <div class="prose dark:prose-invert max-w-none">
                        {!! $rule->content !!}
                    </div>
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Belum Ada Tata Tertib</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Silakan tambahkan tata tertib laboratorium.</p>
                    <a href="{{ route('admin.lab-rules.edit') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl transition-colors">
                        Tambah Tata Tertib
                    </a>
                </div>
            @endif
        </div>

        <!-- Preview Link -->
        <div class="mt-6 flex justify-end">
            <a href="{{ route('lab-rules.public') }}" target="_blank" class="inline-flex items-center text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Lihat Halaman Publik
            </a>
        </div>
    </div>
</div>
