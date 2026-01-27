<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Laboratory;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lab1 = Laboratory::first();
        $lab2 = Laboratory::skip(1)->first();

        $rooms = [
            [
                'name' => 'Lab Komputer 1',
                'code' => 'LK-01',
                'capacity' => 40,
                'facilities' => ['Proyektor', 'AC', 'Whiteboard', 'Komputer 40 unit', 'HDMI'],
                'location' => 'Gedung A Lantai 2',
                'floor' => '2',
                'status' => 'available',
                'description' => 'Laboratorium komputer dengan 40 unit PC untuk praktikum programming dan multimedia',
                'laboratory_id' => $lab1?->id,
            ],
            [
                'name' => 'Lab Komputer 2',
                'code' => 'LK-02',
                'capacity' => 35,
                'facilities' => ['Proyektor', 'AC', 'Whiteboard', 'Komputer 35 unit'],
                'location' => 'Gedung A Lantai 2',
                'floor' => '2',
                'status' => 'available',
                'description' => 'Laboratorium komputer untuk praktikum jaringan dan sistem operasi',
                'laboratory_id' => $lab1?->id,
            ],
            [
                'name' => 'Lab Hardware',
                'code' => 'LH-01',
                'capacity' => 30,
                'facilities' => ['Proyektor', 'AC', 'Whiteboard', 'Meja Kerja', 'Toolset'],
                'location' => 'Gedung B Lantai 1',
                'floor' => '1',
                'status' => 'available',
                'description' => 'Laboratorium untuk praktikum perakitan dan troubleshooting hardware komputer',
                'laboratory_id' => $lab2?->id,
            ],
            [
                'name' => 'Ruang Seminar',
                'code' => 'RS-01',
                'capacity' => 100,
                'facilities' => ['Proyektor', 'AC', 'Sound System', 'Podium', 'Kursi Auditorium'],
                'location' => 'Gedung C Lantai 1',
                'floor' => '1',
                'status' => 'available',
                'description' => 'Ruang seminar untuk presentasi, workshop, dan acara besar',
                'laboratory_id' => null,
            ],
            [
                'name' => 'Lab Jaringan',
                'code' => 'LJ-01',
                'capacity' => 25,
                'facilities' => ['Proyektor', 'AC', 'Whiteboard', 'Rack Server', 'Switch', 'Router'],
                'location' => 'Gedung A Lantai 3',
                'floor' => '3',
                'status' => 'available',
                'description' => 'Laboratorium khusus untuk praktikum networking dan administrasi jaringan',
                'laboratory_id' => $lab1?->id,
            ],
            [
                'name' => 'Lab Multimedia',
                'code' => 'LM-01',
                'capacity' => 30,
                'facilities' => ['Proyektor', 'AC', 'Komputer Spek Tinggi', 'Tablet Grafis', 'Green Screen'],
                'location' => 'Gedung B Lantai 2',
                'floor' => '2',
                'status' => 'available',
                'description' => 'Laboratorium untuk praktikum desain grafis, video editing, dan animasi',
                'laboratory_id' => $lab2?->id,
            ],
            [
                'name' => 'Ruang Meeting',
                'code' => 'RM-01',
                'capacity' => 15,
                'facilities' => ['TV', 'AC', 'Meja Meeting', 'Whiteboard'],
                'location' => 'Gedung A Lantai 1',
                'floor' => '1',
                'status' => 'available',
                'description' => 'Ruang meeting untuk diskusi kelompok dan rapat kecil',
                'laboratory_id' => null,
            ],
            [
                'name' => 'Lab IoT',
                'code' => 'LI-01',
                'capacity' => 20,
                'facilities' => ['Proyektor', 'AC', 'Arduino Kit', 'Raspberry Pi', 'Sensor'],
                'location' => 'Gedung B Lantai 3',
                'floor' => '3',
                'status' => 'maintenance',
                'description' => 'Laboratorium untuk praktikum Internet of Things dan embedded systems (sedang maintenance)',
                'laboratory_id' => $lab2?->id,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
