<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatasetSeeder extends Seeder
{
    public function run()
    {
        // Path ke file CSV
        $filePath = database_path('data/mahasiswa.csv'); // Lokasi file CSV di folder database/data/

        // Pastikan file CSV ada dan dapat dibaca
        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->command->error("File mahasiswa.csv tidak ditemukan atau tidak dapat dibaca di database/data/");
            return;
        }

        $header = null;
        $data = [];

        // Baca isi file CSV
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row; // Baris pertama sebagai header
                } else {
                    $data[] = array_combine($header, $row); // Gabungkan header dengan nilai
                }
            }
            fclose($handle);
        }
        

        // Insert data ke tabel datasets
        foreach ($data as $row) {
            DB::table('datasets')->insert([
                'nim' => $row['NIM'] ?? null,
                'nama' => $row['Nama'] ?? null,
                'tempat_tanggal_lahir' => $row['Tempat dan tanggal lahir'] ?? null,
                'jenis_kelamin' => $row['Jenis kelamin'] ?? null,
                'no_telp' => $row['No. telp'] ?? null,
                'email' => $row['E-mail'] ?? null,
                'alamat' => $row['Alamat'] ?? null,
                'status_pekerjaan' => $row['Status pekerjaan'] ?? null,
                'program_studi' => $row['Program studi'] ?? null,
                'kelas' => $row['Kelas'] ?? null,
               
   'ips_semester_1' => ($row['ips semester 1'] === '-' ? 0 : ($row['ips semester 1'] ?? null)),
'ips_semester_2' => ($row['ips semester 2'] === '-' ? 0 : ($row['ips semester 2'] ?? null)),
'ips_semester_3' => ($row['ips semester 3'] === '-' ? 0 : ($row['ips semester 3'] ?? null)),
'ips_semester_4' => ($row['ips semester 4'] === '-' ? 0 : ($row['ips semester 4'] ?? null)),
'sks_semester_1' => ($row['SKS semester 1'] === '-' ? 0 : ($row['SKS semester 1'] ?? null)),
'sks_semester_2' => ($row['SKS semester 2'] === '-' ? 0 : ($row['SKS semester 2'] ?? null)),
'sks_semester_3' => ($row['SKS semester 3'] === '-' ? 0 : ($row['SKS semester 3'] ?? null)),
'sks_semester_4' => ($row['SKS semester 4'] === '-' ? 0 : ($row['SKS semester 4'] ?? null)),
'matkul_semester_1' => ($row['matkul semester 1'] === '-' ? 0 : ($row['matkul semester 1'] ?? null)),
'matkul_semester_2' => ($row['matkul semester 2'] === '-' ? 0 : ($row['matkul semester 2'] ?? null)),
'matkul_semester_3' => ($row['matkul semester 3'] === '-' ? 0 : ($row['matkul semester 3'] ?? null)),
'matkul_semester_4' => ($row['matkul semester 4'] === '-' ? 0 : ($row['matkul semester 4'] ?? null)),
'status_pembayaran' => $row['Status pembayaran'] ?? null,

                'kelulusan' => $row['kelulusan'] ?? null,
            ]);
        }

        $this->command->info('Dataset berhasil diimpor dari CSV!');
    }
}
