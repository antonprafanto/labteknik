<div class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900">
    <!-- Header -->
    <div class="bg-white/5 backdrop-blur-xl border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        📅 Jadwal Praktikum
                    </h1>
                    <p class="text-indigo-300 mt-1">Semester Ganjil 2025/2026</p>
                </div>
                <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Lab Tabs -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach($laboratories as $lab)
                <button 
                    wire:click="selectLab({{ $lab->id }})"
                    class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ $selectedLab == $lab->id ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'bg-white/10 text-white hover:bg-white/20' }}"
                >
                    {{ $lab->name }}
                </button>
            @endforeach
        </div>

        {{-- Lab Info Card --}}
        @php
            $currentLab = $laboratories->firstWhere('id', $selectedLab);
        @endphp
        @if($currentLab)
            <div class="mb-6 bg-gradient-to-r from-indigo-600/20 to-purple-600/20 backdrop-blur-xl rounded-xl border border-white/20 p-4">
                <div class="flex flex-wrap items-center gap-6 text-white">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm">
                            <span class="text-gray-400">Lokasi:</span>
                            <span class="font-medium ml-1">{{ $currentLab->location ?? 'Belum diatur' }}</span>
                        </span>
                    </div>
                    @if($currentLab->room_number)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            <span class="text-sm">
                                <span class="text-gray-400">Ruang:</span>
                                <span class="font-medium ml-1">{{ $currentLab->room_number }}</span>
                            </span>
                        </div>
                    @endif
                    @if($currentLab->capacity)
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="text-sm">
                                <span class="text-gray-400">Kapasitas:</span>
                                <span class="font-medium ml-1">{{ $currentLab->capacity }} orang</span>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Schedule Table -->
        <div class="bg-white/10 backdrop-blur-xl rounded-2xl border border-white/20 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-600 to-purple-600">
                            <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider border-r border-white/20">Hari</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider border-r border-white/20">Jam</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider border-r border-white/20">Kelas</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider border-r border-white/20">Angkatan</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider border-r border-white/20">Ruang</th>
                            <th class="px-4 py-3 text-left text-sm font-bold text-white uppercase tracking-wider">Praktikum</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @foreach($days as $dayNum => $dayName)
                            @php
                                $currentSlots = ($dayNum == 5) ? $this->fridayTimeSlots : $timeSlots;
                            @endphp
                            @foreach($currentSlots as $index => $timeSlot)
                                @php
                                    $schedule = $this->getScheduleForSlot($dayNum, $timeSlot);
                                    // Logic Break Jumat: Slot ke-3 (index 2) di array fridayTimeSlots
                                    $isBreak = ($dayNum == 5 && $index == 2); 
                                @endphp
                                <tr class="{{ $index % 2 == 0 ? 'bg-white/5' : 'bg-transparent' }} hover:bg-white/10 transition-colors">
                                    @if($index == 0)
                                        <td rowspan="{{ count($currentSlots) }}" class="px-4 py-3 text-sm font-bold text-amber-400 border-r border-white/10 align-top bg-white/5">
                                            {{ $dayName }}
                                        </td>
                                    @endif
                                    @if($isBreak)
                                        <td class="px-4 py-3 text-sm text-gray-300 border-r border-white/10 whitespace-nowrap">
                                            {{ $timeSlot }}
                                        </td>
                                        <td colspan="4" class="px-4 py-3 text-center bg-emerald-600/80 text-white font-bold tracking-widest border-r border-white/10">
                                            🕌 ISTIRAHAT SHOLAT JUM'AT
                                        </td>
                                    @else
                                        <td class="px-4 py-3 text-sm text-gray-300 border-r border-white/10 whitespace-nowrap">
                                            {{ $timeSlot }}
                                        </td>
                                        @if($schedule)
                                            <td class="px-4 py-3 text-sm text-white border-r border-white/10">
                                                {{ $schedule->class_name }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-white border-r border-white/10">
                                                {{ $schedule->schedule_date ? $schedule->schedule_date->format('Y') : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-white border-r border-white/10">
                                                {{ $schedule->laboratory->name ?? '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-sm text-amber-300 font-medium">
                                                {{ $schedule->course_name }}
                                            </td>
                                        @else
                                            <td class="px-4 py-3 text-sm text-gray-500 border-r border-white/10">-</td>
                                            <td class="px-4 py-3 text-sm text-gray-500 border-r border-white/10">-</td>
                                            <td class="px-4 py-3 text-sm text-gray-500 border-r border-white/10">-</td>
                                            <td class="px-4 py-3 text-sm text-gray-500">-</td>
                                        @endif
                                    @endif
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-6 flex flex-wrap gap-4 text-sm text-gray-400">
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-amber-400 rounded"></div>
                <span>Hari</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-amber-300 rounded"></div>
                <span>Nama Praktikum</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 bg-red-500 rounded"></div>
                <span>Waktu Istirahat</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>Laboratorium Fakultas Teknik - Universitas Mulawarman</p>
            <p class="mt-1">Data diperbarui secara otomatis dari sistem</p>
        </div>
    </div>
</div>
