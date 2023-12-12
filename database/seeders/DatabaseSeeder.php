<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            DashboardTableSeeder::class,
        ]);

        DB::table('users')->insert([
            [
                'name' => 'Nusalendra',
                'email' => 'nusalendraalen@gmail.com',
                'password' => Hash::make('nusalendra'),
                'role' => 'HRD',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Arif Shidiqqi',
                'email' => 'podotro625@gmail.com',
                'password' => Hash::make('shidiqqi'),
                'role' => 'Manajer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fiqi Julian Ferdyansyah Wibowo',
                'email' => 'fiqijulian18@gmail.com',
                'password' => Hash::make('fiqijulian'),
                'role' => 'Pelamar',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Laskar Pelangi',
                'email' => 'laskarpelangi@gmail.com',
                'password' => Hash::make('laskarpelangi'),
                'role' => 'Pelamar',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('jabatans')->insert([
            'nama' => 'General Affair',
            'deskripsi' => Str::random(10),
            'benefit_pekerjaan' => Str::random(10),
            'kriteria' => Str::random(10),
            'gaji_awal' => 1500000,
            'gaji_akhir' => 5000000,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('kriterias')->insert([
            [
                'jabatan_id' => 1,
                'nama' => 'Identitas',
                'tipe' => 'Benefit',
                'bobot' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'nama' => 'Kualifikasi',
                'tipe' => 'Benefit',
                'bobot' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'nama' => 'Kontak',
                'tipe' => 'Benefit',
                'bobot' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'nama' => 'Dokumen',
                'tipe' => 'Benefit',
                'bobot' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('subkriterias')->insert([
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Nama Lengkap',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Kota Tempat Lahir',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Tanggal Lahir',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Jenis Kelamin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Agama',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Status',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'nama' => 'Alamat Tinggal',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'nama' => 'Pendidikan Terakhir',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'nama' => 'IPK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'nama' => 'Pengalaman Kerja',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'nama' => 'Pengalaman Organisasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'nama' => 'Nomor Handphone',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'nama' => 'Email',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'nama' => 'Sosial Media',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'nama' => 'Dokumen Surat Lamaran',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'nama' => 'Dokumen CV',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'nama' => 'Dokumen Ijazah',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('pengukurans')->insert([
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 1,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 1,
                'nama' => 'Diisi',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 2,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 2,
                'nama' => 'Diisi',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 3,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 3,
                'nama' => 'Diisi',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 4,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 4,
                'nama' => 'Diisi',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 5,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 5,
                'nama' => 'Diisi',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 6,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 6,
                'nama' => 'Diisi',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 7,
                'nama' => 'Jauh',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 7,
                'nama' => 'Menengah',
                'skor' => 0.071428572,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 1,
                'subkriteria_id' => 7,
                'nama' => 'Dekat',
                'skor' => 0.142857143,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 8,
                'nama' => 'Tidak Sesuai',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 8,
                'nama' => 'Cukup Sesuai',
                'skor' => 0.125,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 8,
                'nama' => 'Sesuai',
                'skor' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 9,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 9,
                'nama' => 'Diisi',
                'skor' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 10,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 10,
                'nama' => 'Diisi',
                'skor' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 11,
                'nama' => 'Kosong',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 2,
                'subkriteria_id' => 11,
                'nama' => 'Diisi',
                'skor' => 0.25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'subkriteria_id' => 12,
                'nama' => 'Tidak Valid',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'subkriteria_id' => 12,
                'nama' => 'Valid',
                'skor' => 0.333333333,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'subkriteria_id' => 13,
                'nama' => 'Tidak Valid',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 3,
                'subkriteria_id' => 13,
                'nama' => 'Valid',
                'skor' => 0.333333333,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 14,
                'nama' => 'Tidak Valid',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 14,
                'nama' => 'Valid',
                'skor' => 0.333333333,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 15,
                'nama' => 'Tidak Valid',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 15,
                'nama' => 'Valid',
                'skor' => 0.333333333,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 16,
                'nama' => 'Tidak Valid',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 16,
                'nama' => 'Valid',
                'skor' => 0.333333333,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 17,
                'nama' => 'Tidak Valid',
                'skor' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_id' => 1,
                'kriteria_id' => 4,
                'subkriteria_id' => 17,
                'nama' => 'Valid',
                'skor' => 0.333333333,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('periodes')->insert([
            'nama' => 'Periode 2023/2024'
        ]);

        DB::table('lowongan_pekerjaans')->insert([
            'periode_id' => 1,
            'jabatan_id' => 1,
            'tanggal_mulai' => '2023-11-24',
            'tanggal_akhir' => '2023-11-30',
            'kuota' => 100,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('data_users')->insert([
            'user_id' => 3,
            'kota_tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '2001-11-01',
            'jenis_kelamin' => 'Laki-Laki',
            'agama' => 'Islam',
            'status' => 'Sudah Menikah',
            'alamat_tinggal' => 'Driyorejo, Gresik',
            'pendidikan_terakhir' => 'Strata 1 (2020 - 2024)',
            'IPK' => '35',
            'pengalaman_kerja' => '["PT. UMDI - Direktur (2012-2024)"]',
            'pengalaman_organisasi' => '["Himpunan Mahasiswa Teknik Informatika - Bendahara (2015-2019)"]',
            'nomor_handphone' => '089677888764',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
