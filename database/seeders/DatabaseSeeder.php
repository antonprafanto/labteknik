<?php

namespace Database\Seeders;

use App\Models\InventoryCategory;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $kepalaLab = User::create([
            'name' => 'Kepala Lab',
            'email' => 'kalab@admin.com',
            'password' => Hash::make('password'),
            'role' => 'head_of_lab',
            'is_active' => true,
        ]);

        $laboran = User::create([
            'name' => 'Laboran',
            'email' => 'laboran@admin.com',
            'password' => Hash::make('password'),
            'role' => 'lab_assistant',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Dosen',
            'email' => 'dosen@admin.com',
            'password' => Hash::make('password'),
            'role' => 'lecturer',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@admin.com',
            'password' => Hash::make('password'),
            'role' => 'student',
            'is_active' => true,
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Elektronika', 'icon' => 'cpu-chip', 'color' => '#EF4444', 'description' => 'Alat-alat elektronik dan komponen'],
            ['name' => 'Mekanik', 'icon' => 'wrench-screwdriver', 'color' => '#F59E0B', 'description' => 'Alat-alat mekanik dan peralatan bengkel'],
            ['name' => 'Komputer', 'icon' => 'computer-desktop', 'color' => '#10B981', 'description' => 'Perangkat keras komputer dan jaringan'],
            ['name' => 'Peralatan Umum', 'icon' => 'beaker', 'color' => '#6366F1', 'description' => 'Peralatan umum laboratorium'],
            ['name' => 'Bahan Habis Pakai', 'icon' => 'test-tube', 'color' => '#8B5CF6', 'description' => 'Bahan kimia dan consumables'],
        ];

        foreach ($categories as $category) {
            InventoryCategory::create($category);
        }

        // Create Laboratories with head assignments
        $lab1 = Laboratory::create([
            'name' => 'Laboratorium Rekayasa Perangkat Lunak',
            'location' => 'Gedung C Lantai 2',
            'room_number' => 'C201',
            'capacity' => 30,
            'status' => 'aktif',
            'description' => 'Lab untuk praktikum pemrograman dan rekayasa perangkat lunak.',
            'head_lab_id' => $kepalaLab->id,
        ]);

        // Sync: Update kepala lab's laboratory_id
        $kepalaLab->update(['laboratory_id' => $lab1->id]);
        $laboran->update(['laboratory_id' => $lab1->id]);

        Laboratory::create([
            'name' => 'Laboratorium Jaringan Komputer',
            'location' => 'Gedung C Lantai 2',
            'room_number' => 'C202',
            'capacity' => 30,
            'status' => 'aktif',
            'description' => 'Lab untuk praktikum jaringan dan keamanan siber.',
        ]);


        // Seed Inventory Items
        $lab = Laboratory::first();
        $category = InventoryCategory::first();
        
        if ($lab && $category) {
            \App\Models\InventoryItem::create([
                'laboratory_id' => $lab->id,
                'category_id' => $category->id,
                'code' => 'INV-2026-001',
                'name' => 'Oscilloscope Digital',
                'brand' => 'Tektronix',
                'model' => 'TBS1052B',
                'purchase_year' => 2023,
                'condition' => 'good',
                'status' => 'available',
                'quantity' => 5,
                'available_quantity' => 5,
                'price' => 5000000,
                'description' => 'Digital storage oscilloscope, 50MHz bandwidth, 2 channels.',
            ]);

            \App\Models\InventoryItem::create([
                'laboratory_id' => $lab->id,
                'category_id' => $category->id,
                'code' => 'INV-2026-002',
                'name' => 'Power Supply DC',
                'brand' => 'Rigol',
                'model' => 'DP832',
                'purchase_year' => 2024,
                'condition' => 'good',
                'status' => 'available',
                'quantity' => 10,
                'available_quantity' => 10,
                'price' => 3500000,
                'description' => 'Programmable DC Power Supply, 3 Channels.',
            ]);
        }

        // Seed Schedules
        $lecturer = User::where('role', 'lecturer')->first();
        if ($lab && $lecturer) {
            \App\Models\PracticumSchedule::create([
                'laboratory_id' => $lab->id,
                'lecturer_id' => $lecturer->id,
                'course_name' => 'Dasar Pemrograman',
                'class_name' => 'Informatika A 2024',
                'schedule_date' => now()->addDays(2),
                'start_time' => '08:00',
                'end_time' => '10:00',
                'participants' => 30,
                'status' => 'scheduled',
                'created_by' => User::where('role', 'super_admin')->first()->id ?? 1,
            ]);
        }

        // Seed Borrowing Requests
        $student = User::where('role', 'student')->first();
        $item1 = \App\Models\InventoryItem::first();
        if ($student && $item1) {
            // Request 1: Pending
            $request1 = \App\Models\BorrowingRequest::create([
                'user_id' => $student->id,
                'borrow_date' => now()->addDays(1),
                'return_date' => now()->addDays(3),
                'purpose' => 'Praktikum Mandiri',
                'status' => 'pending',
                'request_number' => 'REQ-' . date('Ymd') . '-001',
            ]);
            
            \App\Models\BorrowingItem::create([
                'borrowing_request_id' => $request1->id,
                'inventory_item_id' => $item1->id,
                'quantity' => 1,
            ]);

            // Request 2: Approved
            $request2 = \App\Models\BorrowingRequest::create([
                'user_id' => $student->id,
                'borrow_date' => now()->subDays(5),
                'return_date' => now()->subDays(2),
                'purpose' => 'Penelitian Skripsi',
                'status' => 'approved',
                'request_number' => 'REQ-' . date('Ymd') . '-002',
                'approved_by' => User::where('role', 'head_of_lab')->first()->id ?? 1,
                'approved_at' => now()->subDays(6),
            ]);

            \App\Models\BorrowingItem::create([
                'borrowing_request_id' => $request2->id,
                'inventory_item_id' => $item1->id,
                'quantity' => 1,
            ]);
        }

        // Seed Damage Reports
        $item2 = \App\Models\InventoryItem::skip(1)->first();
        if ($item2 && $student) {
            \App\Models\DamageReport::create([
                'inventory_item_id' => $item2->id,
                'reporter_id' => $student->id,
                'damage_type' => 'ringan',
                'description' => 'Tombol power agak keras ditekan, kadang tidak merespon.',
                'status' => 'reported',
            ]);
        }

        // Seed Lab Rules (Tata Tertib)
        \App\Models\LabRule::create([
            'title' => 'Tata Tertib Laboratorium',
            'content' => '<h2>Tata Tertib Laboratorium Fakultas Teknik</h2>
<h3>A. Ketentuan Umum</h3>
<ol>
<li>Setiap pengguna laboratorium wajib mematuhi peraturan yang berlaku.</li>
<li>Pengguna wajib mengisi buku kunjungan/absensi sebelum menggunakan laboratorium.</li>
<li>Dilarang membawa makanan dan minuman ke dalam laboratorium.</li>
<li>Dilarang merokok di dalam dan sekitar area laboratorium.</li>
<li>Menjaga kebersihan dan kerapian laboratorium.</li>
</ol>
<h3>B. Ketentuan Khusus</h3>
<ol>
<li>Pengguna wajib menggunakan peralatan sesuai prosedur yang telah ditetapkan.</li>
<li>Segala kerusakan yang disebabkan oleh kelalaian pengguna menjadi tanggung jawab pengguna.</li>
<li>Peralatan yang dipinjam harus dikembalikan dalam kondisi baik.</li>
<li>Pengguna wajib melaporkan kerusakan atau masalah teknis kepada laboran.</li>
</ol>
<h3>C. Sanksi</h3>
<p>Pelanggaran terhadap tata tertib ini dapat dikenakan sanksi sesuai ketentuan yang berlaku.</p>',
            'is_active' => true,
            'updated_by' => User::where('role', 'super_admin')->first()?->id,
        ]);

        // Seed Lab Activity Categories
        $activityCategories = [
            ['name' => 'Praktikum', 'slug' => 'praktikum', 'description' => 'Kegiatan praktikum mahasiswa', 'color' => '#3B82F6'],
            ['name' => 'Penelitian', 'slug' => 'penelitian', 'description' => 'Kegiatan penelitian dan riset', 'color' => '#8B5CF6'],
            ['name' => 'Workshop', 'slug' => 'workshop', 'description' => 'Kegiatan workshop dan pelatihan', 'color' => '#10B981'],
            ['name' => 'Seminar', 'slug' => 'seminar', 'description' => 'Kegiatan seminar dan presentasi', 'color' => '#F59E0B'],
            ['name' => 'Pelatihan', 'slug' => 'pelatihan', 'description' => 'Kegiatan pelatihan keterampilan', 'color' => '#EF4444'],
        ];

        foreach ($activityCategories as $category) {
            \App\Models\LabActivityCategory::create($category);
        }
    }
}
