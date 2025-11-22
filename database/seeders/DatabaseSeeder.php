<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Setup Faker Bahasa Indonesia
        $faker = Faker::create('id_ID');

        // ==========================================
        // TAHAP 1: MEMBUAT DATA COURSE (KELAS)
        // ==========================================
        $coursesData = [
            [
                'name' => 'Desain Grafis',
                'instructor' => 'Aditya Mahendra',
                'description' => 'Kuasai Adobe Photoshop dan Illustrator untuk kebutuhan branding dan media sosial.'
            ],
            [
                'name' => 'Pemrograman Dasar',
                'instructor' => 'Eko Kurniawan',
                'description' => 'Fundamental logika coding menggunakan Python dan Algoritma dasar bagi pemula.'
            ],
            [
                'name' => 'Editing Video',
                'instructor' => 'Chandra Liow',
                'description' => 'Teknik cutting, coloring, dan transisi video cinematic menggunakan Premiere Pro.'
            ],
            [
                'name' => 'Public Speaking',
                'instructor' => 'Merry Riana',
                'description' => 'Cara mengatasi gugup dan berbicara dengan percaya diri di depan umum.'
            ],
            [
                'name' => 'Entrepreneurship',
                'instructor' => 'Sandiaga Uno',
                'description' => 'Membangun mindset pengusaha dan merancang model bisnis canvas yang solid.'
            ],
            [
                'name' => 'Fashion Design',
                'instructor' => 'Ivan Gunawan',
                'description' => 'Mengenal pola dasar, sketsa busana, dan pemilihan bahan tekstil.'
            ],
            [
                'name' => 'Multimedia',
                'instructor' => 'Dedy Corbuzier',
                'description' => 'Integrasi audio, video, dan animasi untuk produksi konten digital interaktif.'
            ],
            [
                'name' => 'Broadcast',
                'instructor' => 'Najwa Shihab',
                'description' => 'Teknik penyiaran televisi, reportase berita, dan manajemen studio siaran.'
            ],
        ];

        $createdCourses = [];

        foreach ($coursesData as $data) {
            // Create Course (UUID otomatis digenerate oleh Model)
            $createdCourses[] = Course::create($data);
        }

        $this->command->info('✅ Berhasil membuat 8 Kelas.');


        // ==========================================
        // TAHAP 2: MEMBUAT 20 DATA STUDENT
        // ==========================================
        
        for ($i = 1; $i <= 20; $i++) {
            $student = Student::create([
                'name' => $faker->name,
                'email' => $faker->unique()->freeEmail, // freeEmail biar dapet gmail/yahoo
                'phone' => $faker->phoneNumber,
            ]);

            // ==========================================
            // TAHAP 3: RANDOM ENROLLMENT (PIVOT)
            // ==========================================
            // Setiap siswa akan mengambil acak 1 sampai 3 kelas
            
            // Ambil 1-3 course secara acak dari list yang sudah dibuat
            $randomCourses = collect($createdCourses)->random(rand(1, 3));

            foreach ($randomCourses as $course) {
                // Attach dengan UUID manual untuk ID pivot (Sesuai fix sebelumnya)
                $student->courses()->attach($course->id, [
                    'id' => (string) Str::uuid7()
                ]);
            }
        }

        $this->command->info('✅ Berhasil membuat 20 Peserta & Mendaftarkan ke kelas acak.');
    }
}
