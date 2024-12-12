@extends('layouts.app')

@section('content')
<style>
    /* Container Styling */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background-color: #f9f9f9;
    }

    /* Form Styling */
    .form-wrapper {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    header {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    p {
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .input-box {
        margin-bottom: 15px;
        text-align: left;
    }

    .input-box label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .mt-4 {
        margin-top: 20px;
    }

    h3 strong {
        color: #007bff;
    }
</style>

<section class="container">
    <div class="form-wrapper">
        <header>Prediksi Kelulusan</header>
        <p>Masukkan data di bawah untuk memprediksi kelulusan berdasarkan input yang Anda berikan.</p>

        {{-- Formulir untuk memasukkan data prediksi --}}
        <form class="form" action="{{ route('dataset.predict.submit') }}" method="POST">
            @csrf
            <div class="input-box">
                <label for="status_pekerjaan">Status Pekerjaan</label>
                <select class="form-control" id="status_pekerjaan" name="status_pekerjaan" required>
                    <option value="Bekerja">Bekerja</option>
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                </select>
            </div>

            <div class="input-box">
                <label for="total_ips">Total IPS (Jumlah IPS dari 4 semester)</label>
                <input type="number" step="0.01" class="form-control" id="total_ips" name="total_ips" placeholder="Masukkan total IPS" required>
            </div>

            <div class="input-box">
                <label for="total_sks">Total SKS (Jumlah SKS dari 4 semester)</label>
                <input type="number" class="form-control" id="total_sks" name="total_sks" placeholder="Masukkan total SKS" required>
            </div>

            <div class="input-box">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Tidak ada tunggakan">Tidak ada tunggakan</option>
                    <option value="Belum melunasi 1 semester">Belum melunasi 1 semester</option>
                    <option value="Belum melunasi 2 semester">Belum melunasi 2 semester</option>
                    <option value="Belum melunasi 3 semester">Belum melunasi 3 semester</option>
                    <option value="Belum melunasi 4 semester">Belum melunasi 4 semester</option>
                </select>
            </div>

            <button type="submit" class="btn">Prediksi Kelulusan</button>
        </form>

        {{-- Menampilkan hasil prediksi --}}
        @if (isset($predictedGraduation))
            <h3 class="mt-4">Hasil Prediksi Kelulusan: <strong>{{ $predictedGraduation }}</strong></h3>
        @endif
    </div>
</section>
@endsection
