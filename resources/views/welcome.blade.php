<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LabTeknik') }} - Smart Laboratory System</title>
    <meta name="description" content="Sistem Informasi Laboratorium Terpadu Fakultas Teknik Universitas Mulawarman.">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-950 font-sans text-slate-200 selection:bg-indigo-500 selection:text-white overflow-x-hidden">

    <!-- Background Effects -->
    <div class="fixed inset-0 z-[-1]">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-indigo-600/30 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-purple-600/30 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-emerald-600/20 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%239C92AC\' fill-opacity=\'0.03\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative w-10 h-10 flex items-center justify-center bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-indigo-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold text-white tracking-tight leading-none group-hover:text-indigo-300 transition-colors">LabTeknik</span>
                        <span class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">FT Unmul</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#fitur" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Fitur</a>
                    <a href="{{ route('schedules.public') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Jadwal</a>
                    <a href="{{ route('lab-rules.public') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Tata Tertib</a>
                    <a href="{{ route('kegiatan-lab.gallery') }}" class="text-sm font-medium text-slate-300 hover:text-white transition-colors">Galeri</a>
                    <div class="w-px h-6 bg-slate-700 mx-2"></div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 rounded-full transition-all shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-0.5">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-white hover:text-indigo-300 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-slate-900 bg-white hover:bg-slate-50 rounded-full transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden p-2 text-slate-300 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden glass border-t border-white/5 absolute w-full left-0 top-20">
            <div class="px-4 py-6 space-y-4">
                <a href="#fitur" class="block text-slate-300 hover:text-white font-medium">Fitur</a>
                <a href="{{ route('schedules.public') }}" class="block text-slate-300 hover:text-white font-medium">Jadwal Praktikum</a>
                <a href="{{ route('lab-rules.public') }}" class="block text-slate-300 hover:text-white font-medium">Tata Tertib</a>
                <a href="{{ route('kegiatan-lab.gallery') }}" class="block text-slate-300 hover:text-white font-medium">Galeri Kegiatan</a>
                <div class="border-t border-white/10 pt-4 mt-4 grid grid-cols-2 gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="col-span-2 text-center py-2.5 bg-indigo-600 text-white rounded-lg font-semibold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-center py-2.5 text-slate-300 hover:text-white font-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="text-center py-2.5 bg-white text-slate-900 rounded-lg font-semibold">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                
                <!-- Hero Text -->
                <div class="text-center lg:text-left space-y-8 animate-float">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass border-indigo-500/30">
                        <span class="relative flex h-2 w-2">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                        </span>
                        <span class="text-xs font-semibold text-indigo-200 uppercase tracking-widest">Sistem Laboratorium Cerdas v2.0</span>
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-[1.1]">
                        Kelola Lab <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 via-purple-400 to-emerald-400">Lebih Efisien</span>
                    </h1>

                    <p class="text-lg sm:text-xl text-slate-400 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Transformasi digital untuk Fakultas Teknik. Manajemen inventaris, penjadwalan otomatis, dan peminjaman alat dalam satu platform terintegrasi.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl transition-all hover:-translate-y-1 hover:shadow-lg hover:shadow-indigo-600/40 overflow-hidden">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                            <span class="relative flex items-center gap-2">
                                Mulai Sekarang
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </span>
                        </a>
                        <a href="#fitur" class="px-8 py-4 glass text-white font-semibold rounded-2xl hover:bg-white/10 transition-all hover:-translate-y-1 border-white/10 hover:border-white/20">
                            Fitur Lengkap
                        </a>
                    </div>
                </div>

                <!-- Hero Visual -->
                <div class="relative hidden lg:block perspective-1000">
                    <div class="relative z-10 transform rotate-y-12 rotate-x-6 hover:rotate-0 transition-transform duration-700 ease-out preserve-3d">
                        <div class="bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-slate-700/50 shadow-2xl overflow-hidden p-2">
                            <!-- Mockup Header -->
                            <div class="bg-slate-800/50 px-4 py-3 flex items-center gap-2 rounded-t-xl border-b border-slate-700/50">
                                <div class="flex gap-1.5">
                                    <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                </div>
                                <div class="flex-1 text-center">
                                    <div class="inline-block px-3 py-1 bg-slate-950/50 rounded text-[10px] text-slate-500 font-mono">labteknik.ft.unmul.ac.id</div>
                                </div>
                            </div>
                            <!-- Mockup Body -->
                            <div class="bg-slate-950 p-6 space-y-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-indigo-500/10 border border-indigo-500/20 rounded-xl p-4">
                                        <div class="text-indigo-400 mb-1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                        </div>
                                        <div class="text-2xl font-bold text-white">{{ number_format($itemsCount) }}</div>
                                        <div class="text-xs text-indigo-300/60">Total Inventaris</div>
                                    </div>
                                    <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4">
                                        <div class="text-emerald-400 mb-1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                        <div class="text-2xl font-bold text-white">{{ number_format($activeSchedulesCount) }}</div>
                                        <div class="text-xs text-emerald-300/60">Jadwal Aktif</div>
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <div class="h-2 bg-slate-800 rounded w-3/4"></div>
                                    <div class="h-2 bg-slate-800 rounded w-1/2"></div>
                                    <div class="h-2 bg-slate-800 rounded w-5/6"></div>
                                </div>
                                <div class="flex gap-3 mt-4">
                                    <div class="h-24 flex-1 bg-slate-900 rounded-xl border border-slate-800 p-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-800 mb-2"></div>
                                        <div class="h-1.5 bg-slate-800 rounded w-12"></div>
                                    </div>
                                    <div class="h-24 flex-1 bg-slate-900 rounded-xl border border-slate-800 p-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-800 mb-2"></div>
                                        <div class="h-1.5 bg-slate-800 rounded w-12"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Decorative Elements -->
                    <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl rotate-12 blur-sm opacity-50 -z-10 animate-float-delayed"></div>
                    <div class="absolute -bottom-5 -left-5 w-20 h-20 bg-emerald-500 rounded-full blur-xl opacity-20 -z-10 animate-pulse-slow"></div>
                </div>
            </div>
        </div>

        <!-- Scroll Down -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <a href="#statistik" class="p-2 text-slate-500 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </a>
        </div>
    </section>

    <!-- Statistics Section -->
    <section id="statistik" class="py-20 bg-slate-900 border-y border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-slate-800/50">
                <div class="p-4 group">
                    <div class="text-4xl lg:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">{{ $labsCount }}<span class="text-indigo-500">+</span></div>
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Laboratorium</div>
                </div>
                <div class="p-4 group">
                    <div class="text-4xl lg:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">{{ ($itemsCount > 500 ? '500+' : $itemsCount) }}<span class="text-emerald-500">+</span></div>
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Alat & Bahan</div>
                </div>
                <div class="p-4 group">
                    <div class="text-4xl lg:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">{{ ($studentsCount > 1000 ? number_format($studentsCount/1000, 1) . 'k' : $studentsCount) }}<span class="text-purple-500">+</span></div>
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Mahasiswa</div>
                </div>
                <div class="p-4 group">
                    <div class="text-4xl lg:text-5xl font-black text-white mb-2 group-hover:scale-110 transition-transform duration-300">100<span class="text-indigo-500">%</span></div>
                    <div class="text-sm font-semibold text-slate-500 uppercase tracking-widest">Digital</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="py-24 relative overflow-hidden bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-indigo-400 font-semibold tracking-wide uppercase mb-3">Fitur Unggulan</h2>
                <h3 class="text-3xl lg:text-4xl font-bold text-white mb-6">Solusi Komprehensif Manajemen Lab</h3>
                <p class="text-slate-400 text-lg">Semua yang Anda butuhkan untuk mengelola laboratorium modern ada di sini.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group relative bg-slate-900/50 rounded-3xl p-8 border border-white/5 hover:border-indigo-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl"></div>
                    <div class="w-14 h-14 bg-slate-800 rounded-2xl flex items-center justify-center mb-6 border border-white/10 group-hover:scale-110 transition-transform duration-300 group-hover:bg-indigo-500 group-hover:border-transparent">
                        <svg class="w-7 h-7 text-indigo-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Inventaris Pintar</h4>
                    <p class="text-slate-400 leading-relaxed">
                        Lacak lokasi, kondisi, dan riwayat peminjaman setiap alat secara realtime dengan sistem tagging canggih.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-slate-900/50 rounded-3xl p-8 border border-white/5 hover:border-emerald-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl"></div>
                    <div class="w-14 h-14 bg-slate-800 rounded-2xl flex items-center justify-center mb-6 border border-white/10 group-hover:scale-110 transition-transform duration-300 group-hover:bg-emerald-500 group-hover:border-transparent">
                        <svg class="w-7 h-7 text-emerald-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Jadwal Terintegrasi</h4>
                    <p class="text-slate-400 leading-relaxed">
                        Cegah bentrok jadwal praktikum dengan sistem kalender pintar. Sinkronisasi otomatis untuk dosen dan asisten.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-slate-900/50 rounded-3xl p-8 border border-white/5 hover:border-purple-500/30 transition-all duration-300 hover:-translate-y-2">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl"></div>
                    <div class="w-14 h-14 bg-slate-800 rounded-2xl flex items-center justify-center mb-6 border border-white/10 group-hover:scale-110 transition-transform duration-300 group-hover:bg-purple-500 group-hover:border-transparent">
                        <svg class="w-7 h-7 text-purple-400 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-3">Peminjaman Online</h4>
                    <p class="text-slate-400 leading-relaxed">
                        Permudah mahasiswa meminjam alat dengan formulir digital, approval workflow, dan notifikasi otomatis.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-24 bg-slate-900 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl lg:text-4xl font-bold text-white mb-4">Mulai Dalam 3 Langkah</h3>
            </div>
            
            <div class="relative grid md:grid-cols-3 gap-12">
                <!-- Connector Line -->
                <div class="hidden md:block absolute top-[2.5rem] left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-indigo-900 via-indigo-500 to-indigo-900 opacity-30"></div>

                <!-- Step 1 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 mx-auto bg-slate-950 border-4 border-slate-800 rounded-full flex items-center justify-center relative z-10 group-hover:border-indigo-500 transition-colors duration-300">
                        <span class="text-2xl font-bold text-slate-500 group-hover:text-indigo-400">1</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mt-6 mb-2">Registrasi Akun</h4>
                    <p class="text-slate-400 text-sm px-8">Daftarkan diri Anda menggunakan email universitas resmi.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 mx-auto bg-slate-950 border-4 border-slate-800 rounded-full flex items-center justify-center relative z-10 group-hover:border-emerald-500 transition-colors duration-300">
                        <span class="text-2xl font-bold text-slate-500 group-hover:text-emerald-400">2</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mt-6 mb-2">Verifikasi Data</h4>
                    <p class="text-slate-400 text-sm px-8">Admin akan memverifikasi status keanggotaan Anda.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative text-center group">
                    <div class="w-20 h-20 mx-auto bg-slate-950 border-4 border-slate-800 rounded-full flex items-center justify-center relative z-10 group-hover:border-purple-500 transition-colors duration-300">
                        <span class="text-2xl font-bold text-slate-500 group-hover:text-purple-400">3</span>
                    </div>
                    <h4 class="text-xl font-bold text-white mt-6 mb-2">Akses Penuh</h4>
                    <p class="text-slate-400 text-sm px-8">Mulai gunakan fitur peminjaman dan jadwal lab.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-slate-950 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white text-center mb-16">Kata Mereka</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-slate-900 p-8 rounded-2xl border border-white/5 hover:border-indigo-500/20 transition-all">
                    <div class="flex items-center gap-1 text-yellow-500 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-slate-300 mb-6 italicy">"Sangat membantu dalam mengelola jadwal praktikum. Tidak ada lagi bentrok jadwal antar kelas."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center font-bold text-white">DS</div>
                        <div>
                            <div class="text-white font-semibold text-sm">Dr. Santoso</div>
                            <div class="text-slate-500 text-xs">Kepala Lab Elektro</div>
                        </div>
                    </div>
                </div>
                 <!-- Card 2 -->
                 <div class="bg-slate-900 p-8 rounded-2xl border border-white/5 hover:border-emerald-500/20 transition-all">
                    <div class="flex items-center gap-1 text-yellow-500 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-slate-300 mb-6 italicy">"Peminjaman alat jadi sangat praktis, tinggal klik dari HP, ambil alat, selesai!"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center font-bold text-white">AD</div>
                        <div>
                            <div class="text-white font-semibold text-sm">Andi</div>
                            <div class="text-slate-500 text-xs">Mahasiswa Teknik Sipil</div>
                        </div>
                    </div>
                </div>
                 <!-- Card 3 -->
                 <div class="bg-slate-900 p-8 rounded-2xl border border-white/5 hover:border-purple-500/20 transition-all">
                    <div class="flex items-center gap-1 text-yellow-500 mb-4">
                        ★★★★★
                    </div>
                    <p class="text-slate-300 mb-6 italicy">"Inventarisasi alat yang dulunya manual sekarang serba digital. Tracking kondisi alat jadi mudah."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center font-bold text-white">MR</div>
                        <div>
                            <div class="text-white font-semibold text-sm">Maria</div>
                            <div class="text-slate-500 text-xs">Laboran Teknik Kimia</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 relative">
        <div class="absolute inset-0 bg-indigo-600/10"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Siap untuk Modernisasi Laboratorium Anda?</h2>
            <p class="text-indigo-200 text-lg mb-10">Bergabunglah dengan ribuan mahasiswa dan dosen yang telah merasakan kemudahan LabTeknik.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors shadow-xl">
                        Kembali ke Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-colors shadow-xl">
                        Daftar Akun Gratis
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-900 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 flex items-center justify-center bg-indigo-600 rounded-lg">
                             <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        </div>
                        <span class="text-2xl font-bold text-white">LabTeknik</span>
                    </div>
                    <p class="text-slate-500 leading-relaxed max-w-sm">
                        Platform digital terintegrasi untuk manajemen laboratorium Fakultas Teknik Universitas Mulawarman. Mewujudkan lingkungan akademik yang cerdas dan efisien.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Navigasi</h4>
                    <ul class="space-y-3 text-slate-400 text-sm">
                        <li><a href="#fitur" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="{{ route('schedules.public') }}" class="hover:text-white transition-colors">Jadwal Praktikum</a></li>
                        <li><a href="#statistik" class="hover:text-white transition-colors">Statistik Lab</a></li>
                        @guest
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Login Staff</a></li>
                        @endguest
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-bold mb-6">Kontak</h4>
                    <ul class="space-y-3 text-slate-400 text-sm">
                        <li class="flex gap-3">
                            <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Fakultas Teknik, Universitas Mulawarman, Samarinda
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-5 h-5 text-indigo-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <div class="flex flex-col">
                                <a href="mailto:antonprafanto@unmul.ac.id" class="hover:text-indigo-400 transition-colors">antonprafanto@unmul.ac.id</a>
                                <a href="mailto:slamat.heriady@gmail.com" class="hover:text-indigo-400 transition-colors">slamat.heriady@gmail.com</a>
                            </div>
                        </li>
                        <li class="flex gap-3">
                            <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <a href="https://wa.me/62811553393" target="_blank" class="hover:text-emerald-400 transition-colors">0811-553-393</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-900 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-600">
                <p>&copy; {{ date('Y') }} LabTeknik. All rights reserved.</p>
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4">
                    <p>Dikembangkan oleh <span class="text-indigo-400 font-medium">Anton & Jack</span> — Informatika UNMUL</p>
                    <span class="hidden md:inline text-slate-700">|</span>
                    <div class="flex items-center gap-3">
                        <a href="mailto:antonprafanto@unmul.ac.id" class="flex items-center gap-1.5 text-indigo-400 hover:text-indigo-300 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email
                        </a>
                        <a href="https://wa.me/62811553393" target="_blank" class="flex items-center gap-1.5 text-emerald-400 hover:text-emerald-300 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('bg-slate-950/80', 'backdrop-blur-lg', 'border-b', 'border-white/5');
            } else {
                navbar.classList.remove('bg-slate-950/80', 'backdrop-blur-lg', 'border-b', 'border-white/5');
            }
        });
    </script>
</body>
</html>
