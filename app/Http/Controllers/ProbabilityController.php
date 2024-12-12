<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;
use Illuminate\Support\Collection;
use MathPHP\Statistics\Descriptive;



class ProbabilityController extends Controller
{
    public function probabilities()
    {
        // Ambil semua dataset
        $datasets = Dataset::all();

        // Data berdasarkan kelulusan
        $lulus = $datasets->where('kelulusan', 'Lulus');
        $tidakLulus = $datasets->where('kelulusan', 'Tidak Lulus');

        // Hitung total data untuk lulus dan tidak lulus
        $totalLulus = $lulus->count();
        $totalTidakLulus = $tidakLulus->count();

        // **Tabel Probabilitas IPK**
        $categories = ['Sangat Memuaskan', 'Memuaskan', 'Cukup', 'Kurang'];
        $ipkProbabilities = [];
        foreach ($categories as $category) {
            $ipkProbabilities[$category] = [
                'Lulus' => $lulus->filter(fn($data) => $this->categorizeIPK($data) === $category)->count(),
                'Tidak Lulus' => $tidakLulus->filter(fn($data) => $this->categorizeIPK($data) === $category)->count(),
            ];
        }

        // **Tabel Probabilitas SKS**
        $lulusSks = collect($lulus->flatMap(fn($data) => [
            $data->sks_semester_1 +
            $data->sks_semester_2 +
            $data->sks_semester_3 +
            $data->sks_semester_4 
        ]))->filter();

        $tidakLulusSks = collect($tidakLulus->flatMap(fn($data) => [
            $data->sks_semester_1+
            $data->sks_semester_2+
            $data->sks_semester_3+
            $data->sks_semester_4
        ]))->filter();

        $lulusMatkul = collect($lulus->flatMap(fn($data) => [
            $data->matkul_semester_1 +
            $data->matkul_semester_2 +
            $data->matkul_semester_3 +
            $data->matkul_semester_4 
        ]))->filter();

        $tidakLulusMatkul = collect($tidakLulus->flatMap(fn($data) => [
            $data->matkul_semester_1+
            $data->matkul_semester_2+
            $data->matkul_semester_3+
            $data->matkul_semester_4
        ]))->filter();



        


        $sksProbabilities = [
            'meanYaHasil' => $lulusSks->average(),
            'meanTidakHasil' => $tidakLulusSks->average(),
            'stddevYaHasil' => $this->calculateStdDev($lulusSks),
            'stddevTidakHasil' => $this->calculateStdDev($tidakLulusSks),
        ];
        $matkulProbabilities = [
            'meanYaHasil' => $lulusMatkul->average(),
            'meanTidakHasil' => $tidakLulusMatkul->average(),
            'stddevYaHasil' => $this->calculateStdDev($lulusMatkul),
            'stddevTidakHasil' => $this->calculateStdDev($tidakLulusMatkul),
        ];

        // **Tabel Status Pekerjaan**
        $probabilities['Status Pekerjaan'] = [
            'Bekerja' => [
                'Lulus' => $lulus->where('status_pekerjaan', 'Bekerja')->count(),
                'Tidak Lulus' => $tidakLulus->where('status_pekerjaan', 'Bekerja')->count(),
            ],
            'Tidak Bekerja' => [
                'Lulus' => $lulus->where('status_pekerjaan', 'Tidak Bekerja')->count(),
                'Tidak Lulus' => $tidakLulus->where('status_pekerjaan', 'Tidak Bekerja')->count(),
            ],
        ];

        // Tambahkan probabilitas IPK ke dalam variabel probabilities
        $probabilities['IPK'] = $ipkProbabilities;

        $pembayaran = [

        ];
        $datasets = Dataset::all();

    // Data berdasarkan kelulusan
    $lulus = $datasets->where('kelulusan', 'Lulus');
    $tidakLulus = $datasets->where('kelulusan', 'Tidak Lulus');

    // Hitung total data untuk lulus dan tidak lulus
    $totalLulus = $lulus->count();
    $totalTidakLulus = $tidakLulus->count();

    // **Tabel Probabilitas Status Pembayaran**
    $statusPembayaranCategories = [
        'Tidak ada tunggakan',
        'Belum melunasi 1 semester',
        'Belum melunasi 2 semester',
        'Belum melunasi 3 semester',
        'Belum melunasi 4 semester',
    ];

    $statusPembayaranProbabilities = [];
    foreach ($statusPembayaranCategories as $category) {
        $statusPembayaranProbabilities[$category] = [
            'Lulus' => $lulus->where('status_pembayaran', $category)->count(),
            'Tidak Lulus' => $tidakLulus->where('status_pembayaran', $category)->count(),
        ];
    }

    // Tambahkan probabilitas Status Pembayaran ke dalam variabel probabilities
    $probabilities['Status Pembayaran'] = $statusPembayaranProbabilities;


        // Return data ke view
        return view('probabilities', compact('probabilities', 'sksProbabilities', 'totalLulus', 'totalTidakLulus','matkulProbabilities',));
    }

    // Fungsi untuk mengkategorikan IPK
    private function categorizeIPK($data)
    {
        $averageIPK = collect([
            $data->ips_semester_1,
            $data->ips_semester_2,
            $data->ips_semester_3,
            $data->ips_semester_4,
        ])->filter()->average();

        if ($averageIPK >= 3.5) {
            return 'Sangat Memuaskan';
        } elseif ($averageIPK >= 3.0) {
            return 'Memuaskan';
        } elseif ($averageIPK >= 2.5) {
            return 'Cukup';
        } else {
            return 'Kurang';
        }
    }


    private function calculateStdDev(Collection $values)
    {
        // Konversi koleksi menjadi array dan pastikan hanya nilai numerik yang diproses
        $valuesArray = $values->filter(fn($value) => is_numeric($value))->toArray();
    
        // Cek apakah array memiliki cukup elemen (lebih dari 1 nilai)
        if (count($valuesArray) < 2) {
            return 0;
        }
    
        // Menghitung standar deviasi menggunakan MathPHP
        return Descriptive::standardDeviation($valuesArray);
    }
    
}
