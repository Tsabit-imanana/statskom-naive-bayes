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
        background-color: #FCEDDA;
        padding: 15px;
        box-sizing: border-box;
    }

    /* Form Styling */
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
        font-size: 1.2rem;
        color: #000;
        font-weight: 600;
        text-align: center;
    }

    .form .input-box {
        width: 100%;
        margin-top: 10px;
    }

    .input-box label {
        color: #000;
    }

    .form :where(.input-box input, .select-box) {
        position: relative;
        height: 35px;
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
        height: 40px;
        width: 100%;
        color: #000;
        font-size: 1rem;
        font-weight: 400;
        margin-top: 15px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #EE4E34;
    }

    .form button:hover {
        background: #EE3E34;
    }
</style>

<div class="container">
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
</div>
@endsection
