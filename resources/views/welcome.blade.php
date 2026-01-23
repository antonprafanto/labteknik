<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LabTeknik') }} - Sistem Informasi Laboratorium</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-slate-900/90 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative w-10 h-10 flex items-center justify-center bg-indigo-600 rounded-xl group-hover:bg-indigo-500 transition-colors shadow-lg shadow-indigo-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-xl font-bold text-white tracking-tight">LabTeknik</span>
                        <span class="block text-xs text-slate-400 font-medium tracking-wide">FAKULTAS TEKNIK UNMUL</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#fitur" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Fitur</a>
                    <a href="{{ route('schedules.public') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Jadwal Praktikum</a>
                    <a href="#stat" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Statistik</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-full transition-all shadow-lg shadow-indigo-500/25">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-indigo-400 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-semibold text-slate-900 bg-white hover:bg-slate-100 rounded-full transition-all">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-slate-900 pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-indigo-600/30 rounded-full blur-[100px] opacity-50 mix-blend-screen"></div>
            <div class="absolute top-40 -left-20 w-[400px] h-[400px] bg-purple-600/30 rounded-full blur-[100px] opacity-40 mix-blend-screen"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-800/50 border border-slate-700/50 backdrop-blur-sm mb-8">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-sm font-medium text-indigo-300">Sistem Informasi Laboratorium Terpadu</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight mb-8">
                    Kelola Laboratorium <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-indigo-400">Lebih Cerdas & Efisien</span>
                </h1>
                
                <p class="text-xl text-slate-400 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Platform digital terintegrasi untuk manajemen inventaris alat, penjadwalan praktikum otomatis, dan peminjaman digital.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-500/20 transform hover:-translate-y-1">
                            Akses Dashboard
                            <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-500 transition-all shadow-xl shadow-indigo-500/20 transform hover:-translate-y-1">
                            Mulai Sekarang
                            <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @endauth
                    
                    <a href="{{ route('schedules.public') }}" class="w-full sm:w-auto px-8 py-4 bg-slate-800 text-white font-semibold rounded-2xl hover:bg-slate-700 transition-all border border-slate-700/50">
                        <span class="mr-2">📅</span> Cek Jadwal
                    </a>
                </div>
            </div>
            
            <!-- Dashboard Preview Mockup -->
            <div class="mt-20 relative mx-auto max-w-5xl">
                <div class="bg-gray-900 rounded-3xl border border-gray-800 shadow-2xl p-2 md:p-4 relative z-10">
                    <div class="absolute inset-0 bg-gradient-to-b from-indigo-500/10 to-transparent rounded-3xl pointer-events-none"></div>
                    <div class="bg-slate-900 rounded-2xl overflow-hidden border border-gray-800 aspect-[16/10] relative flex items-center justify-center">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-slate-800 rounded-2xl mx-auto flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-slate-500 font-medium">Dashboard Preview</p>
                        </div>
                        
                        <!-- Decorative Elements simulating UI -->
                        <div class="absolute top-0 left-0 w-full h-full opacity-30">
                            <div class="absolute top-6 left-6 w-48 h-12 bg-slate-800 rounded-lg"></div>
                            <div class="absolute top-6 right-6 flex gap-4">
                                <div class="w-12 h-12 bg-slate-800 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Glow behind mockup -->
                <div class="absolute -inset-4 bg-indigo-500/20 blur-3xl rounded-[3rem] -z-10"></div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div id="stat" class="py-10 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-slate-900">50+</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide mt-1">Laboratorium</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-indigo-600">500+</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide mt-1">Alat & Bahan</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-purple-600">1.2k</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide mt-1">Mahasiswa</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-extrabold text-emerald-600">100%</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide mt-1">Digitalisasi</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="fitur" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-indigo-600 font-bold tracking-wide uppercase text-sm mb-3">Fitur Unggulan</h2>
                <h3 class="text-4xl font-bold text-slate-900 mb-6">Solusi Lengkap Manajemen Lab</h3>
                <p class="text-lg text-slate-600 leading-relaxed">
                    Dirancang khusus untuk kebutuhan laboratorium modern di lingkungan akademik. Semua fitur terintegrasi dalam satu sistem.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Inventaris Pintar</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Database peralatan lengkap dengan status kondisi, lokasi penyimpanan, dan riwayat pemeliharaan.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                     <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Jadwal Digital</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Tampilan jadwal praktikum yang transparan. Deteksi konflik otomatis untuk menghindari tabrakan jadwal.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/50 border border-slate-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                     <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Peminjaman Online</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Proses peminjaman alat tanpa kertas. Pengajuan, persetujuan, dan pengembalian tercatat secara digital.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 bg-slate-900 relative overflow-hidden">
         <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-indigo-600/20 rounded-full blur-[100px] mix-blend-screen"></div>
            <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-purple-600/20 rounded-full blur-[100px] mix-blend-screen"></div>
        </div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Digitalisasi Laboratorium Anda?</h2>
            <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan transformasi digital Fakultas Teknik. Kelola lebih mudah, lebih cepat, dan lebih akurat.
            </p>
            @auth
                 <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-10 py-4 bg-white text-slate-900 font-bold rounded-2xl hover:bg-indigo-50 transition-all transform hover:scale-105">
                    Kembali ke Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-10 py-4 bg-white text-slate-900 font-bold rounded-2xl hover:bg-indigo-50 transition-all transform hover:scale-105">
                    Daftar Sekarang - Gratis
                </a>
            @endauth
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-12">
                 <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">LabTeknik</span>
                </div>
                
                <div class="flex gap-8 text-sm text-slate-400">
                    <a href="#" class="hover:text-white transition-colors">Bantuan</a>
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Kontak</a>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-slate-500">
                    &copy; {{ date('Y') }} Laboratorium Fakultas Teknik Universitas Mulawarman.
                </p>
                <p class="text-sm text-slate-500 mt-2 md:mt-0">
                    Developed by <span class="text-slate-300">TI 2026</span>
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
