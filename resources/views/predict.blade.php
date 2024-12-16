@extends('layouts.app')

@section('content')
<style>
    /* Styling untuk form dan container */
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        background-color: #FCEDDA;
        padding: 15px;
        box-sizing: border-box;
    }

    .form-wrapper {
        background-color: #FCEDDA;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 30px 5px 30px rgba(1, 0, 0, 0.3);
        max-width: 800px;
        width: 100%;
        background: #FCEDDA;
    }

    .container header {
        font-size: 1.5rem;
        color: #000;
        font-weight: 600;
        text-align: center;
        margin-bottom: 20px;
    }

    .form .input-box {
        width: 100%;
        margin-top: 10px;
    }

    .input-box label {
        color: #000;
        font-size: 1rem;
    }

    .form :where(.input-box input, .select-box) {
        position: relative;
        height: 40px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: #808080;
        margin-top: 5px;
        border: 1px solid #EE4E34;
        border-radius: 6px;
        padding: 0 15px;
        background: #FCEDDA;
    }

    .input-box input:focus {
        box-shadow: 10px 10px 0 rgba(0, 0, 0, 0.1);
    }

    .form button {
        height: 45px;
        width: 100%;
        color: #fff;
        font-size: 1rem;
        font-weight: 500;
        margin-top: 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #EE4E34;
    }

    .form button:hover {
        background: #C04027;
    }

    .results {
        margin-top: 20px;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .results h3 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 10px;
    }

    .results p {
        font-size: 1rem;
        color: #555;
    }
</style>

<div class="container">
    <div class="form-wrapper">
        <header>Prediksi Kelulusan Mahasiswa</header>
        <p>Masukkan data Anda di bawah untuk memprediksi kelulusan berdasarkan informasi yang diberikan.</p>

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
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Tidak ada tunggakan">Tidak ada tunggakan</option>
                    <option value="Belum melunasi 1 semester">Belum melunasi 1 semester</option>
                    <option value="Belum melunasi 2 semester">Belum melunasi 2 semester</option>
                    <option value="Belum melunasi 3 semester">Belum melunasi 3 semester</option>
                    <option value="Belum melunasi 4 semester">Belum melunasi 4 semester</option>
                </select>
            </div>

            <div class="input-box">
                <label for="average_ipk">Rata-rata IPK</label>
                <input type="number" step="0.01" class="form-control" id="average_ipk" name="average_ipk" placeholder="Masukkan rata-rata IPK Anda (0.0 - 4.0)" required>
            </div>

            <div class="input-box">
                <label for="total_matkul_lulus">Jumlah Mata Kuliah Lulus</label>
                <input type="number" class="form-control" id="total_matkul_lulus" name="total_matkul_lulus" placeholder="Masukkan jumlah mata kuliah yang lulus" required>
            </div>

            <div class="input-box">
                <label for="total_sks">Total SKS</label>
                <input type="number" class="form-control" id="total_sks" name="total_sks" placeholder="Masukkan total SKS yang Anda tempuh" required>
            </div>

            <button type="submit" class="btn">Prediksi Kelulusan</button>
        </form>

        {{-- Menampilkan hasil prediksi --}}
        @if (isset($predictedGraduation))
            <div class="results">
                <h3>Hasil Prediksi Kelulusan</h3>
                <p><strong>Status:</strong> {{ $predictedGraduation }}</p>
                <p><strong>Rata-rata IPK Anda:</strong> {{ $average_ipk_user }}</p>
                <p><strong>Rata-rata IPK Mahasiswa:</strong> {{ $average_ipk_database }}</p>
                <p><strong>Jumlah Mata Kuliah Lulus Anda:</strong> {{ $total_matkul_user }}</p>
                <p><strong>Rata-rata Jumlah Mata Kuliah Mahasiswa:</strong> {{ $average_matkul_database }}</p>
                <p><strong>Total SKS Anda:</strong> {{ $total_sks_user }}</p>
                <p><strong>Rata-rata Total SKS Mahasiswa:</strong> {{ $average_sks_database }}</p>
            </div>
        @endif
    </div>
</div>
@endsection
