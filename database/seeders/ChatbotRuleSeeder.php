<?php

namespace Database\Seeders;

use App\Models\ChatbotRule;
use Illuminate\Database\Seeder;

class ChatbotRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // ── Sertifikat ────────────────────────────────────────────────────
            [
                'category' => 'sertifikat',
                'keyword'  => 'sertifikat',
                'response' => 'Selamat! Sertifikat akan otomatis tersedia di dashboard Anda setelah Anda menyelesaikan semua kursus dalam learning path yang dipilih. Anda dapat mengunduhnya dalam format PDF kapan saja.',
                'priority' => 10,
                'is_active' => true,
            ],
            [
                'category' => 'sertifikat',
                'keyword'  => 'unduh sertifikat',
                'response' => 'Untuk mengunduh sertifikat, buka menu "Profil" → "Sertifikat Saya" dan klik tombol Download pada sertifikat yang tersedia.',
                'priority' => 15,
                'is_active' => true,
            ],

            // ── Ujian / Quiz ──────────────────────────────────────────────────
            [
                'category' => 'ujian',
                'keyword'  => 'ujian',
                'response' => 'Ujian (quiz) tersedia di akhir setiap kursus. Anda harus mendapatkan nilai minimal 70 untuk dianggap lulus. Jika tidak lulus, Anda dapat mencoba ulang sebanyak yang diperlukan.',
                'priority' => 10,
                'is_active' => true,
            ],
            [
                'category' => 'ujian',
                'keyword'  => 'nilai',
                'response' => 'Nilai ujian Anda dapat dilihat di halaman detail kursus pada bagian "Progress Saya". Nilai minimal kelulusan adalah 70 dari 100.',
                'priority' => 8,
                'is_active' => true,
            ],

            // ── Error / Masalah Teknis ────────────────────────────────────────
            [
                'category' => 'teknis',
                'keyword'  => 'error',
                'response' => 'Mohon maaf atas ketidaknyamanannya. Jika Anda mengalami error, coba langkah berikut: (1) Refresh halaman, (2) Bersihkan cache browser, (3) Coba browser lain. Jika masalah berlanjut, hubungi support@brainpath.id.',
                'priority' => 10,
                'is_active' => true,
            ],
            [
                'category' => 'teknis',
                'keyword'  => 'tidak bisa login',
                'response' => 'Jika Anda tidak bisa login, pastikan email dan password Anda benar. Gunakan fitur "Lupa Password" jika perlu. Jika masalah berlanjut, hubungi support@brainpath.id.',
                'priority' => 12,
                'is_active' => true,
            ],

            // ── Password ──────────────────────────────────────────────────────
            [
                'category' => 'akun',
                'keyword'  => 'password',
                'response' => 'Untuk mengubah password, buka "Pengaturan Akun" → "Keamanan" → "Ubah Password". Masukkan password lama dan password baru Anda. Password baru minimal 8 karakter.',
                'priority' => 10,
                'is_active' => true,
            ],
            [
                'category' => 'akun',
                'keyword'  => 'lupa password',
                'response' => 'Jika Anda lupa password, klik "Lupa Password" di halaman login. Masukkan email terdaftar Anda dan kami akan mengirimkan tautan reset password.',
                'priority' => 15,
                'is_active' => true,
            ],

            // ── Kursus ────────────────────────────────────────────────────────
            [
                'category' => 'kursus',
                'keyword'  => 'kursus',
                'response' => 'BrainPath menyediakan berbagai kursus di bidang Web Development, Data Science, dan Cybersecurity. Setiap kursus dirancang secara berurutan untuk membangun pengetahuan Anda secara bertahap.',
                'priority' => 8,
                'is_active' => true,
            ],

            // ── Rekomendasi ───────────────────────────────────────────────────
            [
                'category' => 'rekomendasi',
                'keyword'  => 'rekomendasi',
                'response' => 'Sistem rekomendasi BrainPath menggunakan AI untuk menyarankan kursus selanjutnya berdasarkan progress belajar Anda. Semakin banyak kursus yang Anda selesaikan, semakin akurat rekomendasinya!',
                'priority' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($rules as $rule) {
            ChatbotRule::updateOrCreate(
                ['keyword' => $rule['keyword']],
                $rule
            );
        }
    }
}
