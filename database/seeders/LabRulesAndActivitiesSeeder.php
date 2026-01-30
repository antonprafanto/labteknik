<?php

namespace Database\Seeders;

use App\Models\LabActivityCategory;
use App\Models\LabRule;
use Illuminate\Database\Seeder;

class LabRulesAndActivitiesSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Lab Rules if not exists
        if (!LabRule::exists()) {
            LabRule::create([
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
            ]);
        }

        // Seed Lab Activity Categories if not exists
        if (!LabActivityCategory::exists()) {
            $categories = [
                ['name' => 'Praktikum', 'slug' => 'praktikum', 'description' => 'Kegiatan praktikum mahasiswa', 'color' => '#3B82F6'],
                ['name' => 'Penelitian', 'slug' => 'penelitian', 'description' => 'Kegiatan penelitian dan riset', 'color' => '#8B5CF6'],
                ['name' => 'Workshop', 'slug' => 'workshop', 'description' => 'Kegiatan workshop dan pelatihan', 'color' => '#10B981'],
                ['name' => 'Seminar', 'slug' => 'seminar', 'description' => 'Kegiatan seminar dan presentasi', 'color' => '#F59E0B'],
                ['name' => 'Pelatihan', 'slug' => 'pelatihan', 'description' => 'Kegiatan pelatihan keterampilan', 'color' => '#EF4444'],
            ];

            foreach ($categories as $category) {
                LabActivityCategory::create($category);
            }
        }
    }
}
