<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;

class PrediksiController extends Controller
{
    public function showPredictionForm()
    {
        return view('predict'); // Menampilkan form prediksi
    }

    public function predict(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'status_pekerjaan' => 'required|string',
            'average_ipk' => 'required|numeric|min:0|max:4',
            'total_matkul_lulus' => 'required|numeric|min:0',
            'total_sks' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|string',
        ]);

        // Input pengguna
        $status_pekerjaan = $validated['status_pekerjaan'];
        $average_ipk_user = $validated['average_ipk'];
        $total_matkul_user = $validated['total_matkul_lulus'];
        $total_sks_user = $validated['total_sks'];
        $status_pembayaran = $validated['status_pembayaran'];

        // Ambil dataset
        $dataset = Dataset::all();

        // Hitung rata-rata dari dataset
        $average_ipk_database = $this->calculateAverageIpkFromDataset($dataset);
        $average_matkul_database = $this->calculateAverageMatkulFromDataset($dataset);
        $average_sks_database = $this->calculateAverageSksFromDataset($dataset);

        // Prediksi kelulusan
        $predictedGraduation = $this->predictGraduation(
            $status_pekerjaan,
            $average_ipk_user,
            $average_ipk_database,
            $total_matkul_user,
            $average_matkul_database,
            $total_sks_user,
            $average_sks_database,
            $status_pembayaran
        );

        // Return ke blade
        return view('predict', compact(
            'predictedGraduation',
            'average_ipk_user',
            'average_ipk_database',
            'total_matkul_user',
            'average_matkul_database',
            'total_sks_user',
            'average_sks_database'
        ));
    }

    private function predictGraduation($status_pekerjaan, $average_ipk_user, $average_ipk_database, $total_matkul_user, $average_matkul_database, $total_sks_user, $average_sks_database, $status_pembayaran)
    {
        if (
            $average_ipk_user >= $average_ipk_database &&
            $total_matkul_user >= $average_matkul_database &&
            $total_sks_user >= $average_sks_database &&
            $status_pekerjaan === 'Bekerja' &&
            $status_pembayaran === 'Tidak ada tunggakan'
        ) {
            return 'Lulus';
        }
        return 'Tidak Lulus';
    }

    private function calculateAverageIpkFromDataset($dataset)
    {
        $total_ipk = 0;
        $count = 0;

        foreach ($dataset as $data) {
            if ($data->ips_semester_1 && $data->ips_semester_2 && $data->ips_semester_3 && $data->ips_semester_4) {
                $total_ipk += ($data->ips_semester_1 + $data->ips_semester_2 + $data->ips_semester_3 + $data->ips_semester_4) / 4;
                $count++;
            }
        }

        return $count > 0 ? $total_ipk / $count : 0;
    }

    private function calculateAverageMatkulFromDataset($dataset)
    {
        $total_matkul = 0;
        $count = 0;

        foreach ($dataset as $data) {
            if ($data->matkul_semester_1 && $data->matkul_semester_2 && $data->matkul_semester_3 && $data->matkul_semester_4) {
                $total_matkul += $data->matkul_semester_1 + $data->matkul_semester_2 + $data->matkul_semester_3 + $data->matkul_semester_4;
                $count++;
            }
        }

        return $count > 0 ? $total_matkul / $count : 0;
    }

    private function calculateAverageSksFromDataset($dataset)
    {
        $total_sks = 0;
        $count = 0;

        foreach ($dataset as $data) {
            if ($data->sks_semester_1 && $data->sks_semester_2 && $data->sks_semester_3 && $data->sks_semester_4) {
                $total_sks += $data->sks_semester_1 + $data->sks_semester_2 + $data->sks_semester_3 + $data->sks_semester_4;
                $count++;
            }
        }

        return $count > 0 ? $total_sks / $count : 0;
    }
}
