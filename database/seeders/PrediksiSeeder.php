<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\File;

class PrediksiSeeder extends Seeder
{
  public function run()
    {
        // Path ke file CSV
        $filePath = database_path('data/mahasiswa.csv');

        // Pastikan file CSV ada dan dapat dibaca
        if (!file_exists($filePath) || !is_readable($filePath)) {
            $this->command->error("File mahasiswa.csv tidak ditemukan atau tidak dapat dibaca di database/data/");
            return;
        }

        $header = null;
        $data = [];

        // Baca file CSV
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row; // Baris pertama sebagai header
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        // Insert semua data mentah ke database
        foreach ($data as $row) {
            DB::table('datasets')->insert([
                'nim' => $row['NIM'] ?? null,
                'nama' => $row['Nama'] ?? null,
                'total_sks_lulus' => $row['Total SKS lulus'] ?? null,
                'total_mata_kuliah_lulus' => $row['Total mata kuliah lulus'] ?? null,
                'status_pembayaran' => $row['Status pembayaran'] ?? null,
                'kelulusan' => $row['Kelulusan'] ?? null,
                'is_cleaned' => false, // Tandai ini sebagai data mentah
            ]);
        }

        $this->command->info('Dataset mentah berhasil diimpor ke database!');
    }
}
