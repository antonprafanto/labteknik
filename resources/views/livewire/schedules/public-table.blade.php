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
