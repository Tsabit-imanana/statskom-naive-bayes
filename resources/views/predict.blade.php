{{-- resources/views/dataset/predict.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Prediksi Kelulusan</h1>
        <p>Masukkan data di bawah untuk memprediksi kelulusan berdasarkan input yang Anda berikan.</p>

        {{-- Formulir untuk memasukkan data prediksi --}}
        <form action="{{ route('dataset.predict.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="status_pekerjaan">Status Pekerjaan</label>
                <select class="form-control" id="status_pekerjaan" name="status_pekerjaan" required>
                    <option value="Bekerja">Bekerja</option>
                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                </select>
            </div>

            <div class="form-group">
                <label for="total_ips">Total IPS (Jumlah IPS dari 4 semester)</label>
                <input type="number" step="0.01" class="form-control" id="total_ips" name="total_ips" required>
            </div>

            <div class="form-group">
                <label for="total_sks">Total SKS (Jumlah SKS dari 4 semester)</label>
                <input type="number" class="form-control" id="total_sks" name="total_sks" required>
            </div>

            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <select class="form-control" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Tidak ada tunggakan">Tidak ada tunggakan</option>
                    <option value="Belum melunasi 1 semester">Belum melunasi 1 semester</option>
                    <option value="Belum melunasi 2 semester">Belum melunasi 2 semester</option>
                    <option value="Belum melunasi 3 semester">Belum melunasi 3 semester</option>
                    <option value="Belum melunasi 4 semester">Belum melunasi 4 semester</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Prediksi Kelulusan</button>
        </form>

        {{-- Menampilkan hasil prediksi --}}
        @if (isset($predictedGraduation))
            <h3 class="mt-4">Hasil Prediksi Kelulusan: <strong>{{ $predictedGraduation }}</strong></h3>
        @endif
    </div>
@endsection
