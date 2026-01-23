<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LabTeknik') }} - Sistem Informasi Laboratorium</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-white overflow-x-hidden">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 dark:bg-gray-950/80 backdrop-blur-lg border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="font-bold text-lg">Lab<span class="text-indigo-600">Teknik</span></span>
                </a>

                <!-- Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#fitur" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Fitur</a>
                    <a href="{{ route('schedules.public') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Jadwal</a>
                    <a href="#kontak" class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Kontak</a>
                </div>

                <!-- Auth -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 rounded-full text-sm text-indigo-600 dark:text-indigo-400 font-medium mb-6">
                    <span class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                    Sistem Informasi Laboratorium Terpadu
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                    Kelola Laboratorium
                    <span class="gradient-text">Lebih Mudah</span>
                </h1>
                
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-10 max-w-xl mx-auto leading-relaxed">
                    Platform digital untuk manajemen inventaris, peminjaman alat, dan penjadwalan praktikum di Fakultas Teknik Universitas Mulawarman.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/25">
                            Buka Dashboard →
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-500/25">
                            Mulai Sekarang →
                        </a>
                    @endauth
                    <a href="{{ route('schedules.public') }}" class="px-8 py-3 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                        📅 Lihat Jadwal
                    </a>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-20">
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                    <div class="text-3xl font-bold text-indigo-600">5+</div>
                    <div class="text-sm text-gray-500 mt-1">Laboratorium</div>
                </div>
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                    <div class="text-3xl font-bold text-purple-600">500+</div>
                    <div class="text-sm text-gray-500 mt-1">Inventaris</div>
                </div>
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                    <div class="text-3xl font-bold text-pink-600">1000+</div>
                    <div class="text-sm text-gray-500 mt-1">Mahasiswa</div>
                </div>
                <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                    <div class="text-3xl font-bold text-emerald-600">24/7</div>
                    <div class="text-sm text-gray-500 mt-1">Akses Online</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="fitur" class="py-20 px-6 bg-gray-50 dark:bg-gray-900/50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Fitur Unggulan</h2>
                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">Semua yang Anda butuhkan untuk mengelola laboratorium dengan efisien</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Manajemen Inventaris</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Kelola semua peralatan lab dengan mudah. Tracking kondisi, lokasi, dan riwayat penggunaan secara real-time.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Jadwal Praktikum</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Atur jadwal praktikum dengan deteksi konflik otomatis. Lihat jadwal lengkap kapan saja, di mana saja.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Peminjaman Digital</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Ajukan peminjaman alat secara online. Proses persetujuan yang transparan dengan notifikasi real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-12 text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Siap untuk memulai?</h2>
                <p class="text-indigo-100 mb-8 max-w-md mx-auto">
                    Daftar sekarang dan nikmati kemudahan mengelola laboratorium secara digital.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-white text-indigo-700 font-semibold rounded-xl hover:bg-indigo-50 transition">
                        Daftar Gratis →
                    </a>
                @endguest
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-50 dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800 py-12 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-3 gap-12">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <span class="font-bold text-lg">Lab<span class="text-indigo-600">Teknik</span></span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        Sistem Informasi Laboratorium Fakultas Teknik Universitas Mulawarman
                    </p>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li>📍 Samarinda, Kalimantan Timur</li>
                        <li>📧 lab.teknik@unmul.ac.id</li>
                        <li>🏢 Fakultas Teknik UNMUL</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Link Cepat</h4>
                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                        <li><a href="{{ route('schedules.public') }}" class="hover:text-indigo-600 transition">📅 Jadwal Praktikum</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">🔐 Login</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-indigo-600 transition">📝 Daftar</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-800 mt-12 pt-8 text-center">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} LabTeknik. Dibuat dengan ❤️ oleh TI 2026
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
