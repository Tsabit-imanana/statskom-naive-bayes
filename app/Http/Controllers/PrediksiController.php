<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;  // Pastikan Anda sudah memiliki model Prediksi
use Illuminate\Http\Request;
use Phpml\ModelManager;
use App\Models\Dataset;



class PrediksiController extends Controller
{
    public function showPredictionForm()
    {
        return view('predict'); // Menampilkan halaman form prediksi
    }

    public function predict(Request $request)
    {
        // Validasi input dari pengguna
        $validated = $request->validate([
            'status_pekerjaan' => 'required|string',
            'total_ips' => 'required|numeric',
            'total_sks' => 'required|integer',
            'status_pembayaran' => 'required|string',
        ]);

        // Menentukan logika prediksi berdasarkan data input
        // Menambahkan contoh logika Naive Bayes atau aturan untuk menghitung prediksi kelulusan
        $status_pekerjaan = $validated['status_pekerjaan'];
        $total_ips = $validated['total_ips'];
        $total_sks = $validated['total_sks'];
        $status_pembayaran = $validated['status_pembayaran'];

        // Contoh prediksi sederhana berdasarkan logika
        $predictedGraduation = $this->predictGraduation($total_ips, $status_pekerjaan, $status_pembayaran);

        return view('predict', compact('predictedGraduation'));
    }

    private function predictGraduation($total_ips, $status_pekerjaan, $status_pembayaran)
    {
        // Logika prediksi sederhana
        if ($total_ips >= 10 && $status_pekerjaan === 'Bekerja' && $status_pembayaran === 'Tidak ada tunggakan') {
            return 'Lulus';
        }

        return 'Tidak Lulus';
    }
}
