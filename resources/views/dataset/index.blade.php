<!-- resources/views/dataset.blade.php -->
@extends('layouts.app')

@section('title', 'Dataset - Naïve Bayes')

@section('content')
    <h1>Dataset Mentah</h1>
    <h2> Dataset aktivitas kuliah
mahasiswa STMIK Widuri angkatan 2021 yang terdiri dari prodi
 Sistem Informasi sebanyak 27 mahasiswa dan prodi Teknik
Informatika sebanyak 34 mahasiswa</h2>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th>{{ ucwords(str_replace('_', ' ', $column)) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($datasets as $data)
                    <tr>
                        @foreach ($columns as $column)
                            <td>{{ $data->$column }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h1>PREPOCESSING</h1>
    <h2>Menghilangkan missing velue atau data outlier yang bisa membuat keputusan menjadi tidak akurat.</h2>
    <p>Total: {{ $filteredDatasets->count() }}</p>


        <div class="table-container">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- Manually defining column headers -->
                        <th>ID</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telp</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Status Pekerjaan</th>
                        <th>Program Studi</th>
                        <th>Kelas</th>
                        <th>IPS Semester 1</th>
                        <th>IPS Semester 2</th>
                        <th>IPS Semester 3</th>
                        <th>IPS Semester 4</th>
                        <th>SKS Semester 1</th>
                        <th>SKS Semester 2</th>
                        <th>SKS Semester 3</th>
                        <th>SKS Semester 4</th>
                        <th>Matkul Semester 1</th>
                        <th>Matkul Semester 2</th>
                        <th>Matkul Semester 3</th>
                        <th>Matkul Semester 4</th>
                        <th>Status Pembayaran</th>
                        <th>Kelulusan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cleanedDatasets as $data)
                        <tr>
                            <!-- Manually defining data rows -->
                            <td>{{ $data->id }}</td>
                            <td>{{ $data->nim }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->tempat_tanggal_lahir }}</td>
                            <td>{{ $data->jenis_kelamin }}</td>
                            <td>{{ $data->no_telp }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->status_pekerjaan }}</td>
                            <td>{{ $data->program_studi }}</td>
                            <td>{{ $data->kelas }}</td>
                            <td>{{ $data->ips_semester_1 }}</td>
                            <td>{{ $data->ips_semester_2 }}</td>
                            <td>{{ $data->ips_semester_3 }}</td>
                            <td>{{ $data->ips_semester_4 }}</td>
                            <td>{{ $data->sks_semester_1 }}</td>
                            <td>{{ $data->sks_semester_2 }}</td>
                            <td>{{ $data->sks_semester_3 }}</td>
                            <td>{{ $data->sks_semester_4 }}</td>
                            <td>{{ $data->matkul_semester_1 }}</td>
                            <td>{{ $data->matkul_semester_2 }}</td>
                            <td>{{ $data->matkul_semester_3 }}</td>
                            <td>{{ $data->matkul_semester_4 }}</td>
                            <td>{{ $data->status_pembayaran }}</td>
                            <td>{{ $data->kelulusan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <h1>Data Selection</h1>
    <h2>Memilih atribut-atribut mana saja yang akan dipakai
        untuk proses klasifikasi naive bayes karena tidak semua atribut pada dataset
        terpakai untuk proses klasifikasi.</h2>


    <p>Total: {{ $filteredDatasets->count() }}</p>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Status Pekerjaan</th>
                    <th>IPS Semester 1</th>
                    <th>IPS Semester 2</th>
                    <th>IPS Semester 3</th>
                    <th>IPS Semester 4</th>
                    <th>SKS Semester 1</th>
                    <th>SKS Semester 2</th>
                    <th>SKS Semester 3</th>
                    <th>SKS Semester 4</th>
                    <th>Matkul Semester 1</th>
                    <th>Matkul Semester 2</th>
                    <th>Matkul Semester 3</th>
                    <th>Matkul Semester 4</th>
                    <th>Status Pembayaran</th>
                    <th>Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cleanedDatasets as $data)
                    <tr>
                        <td>{{ $data->status_pekerjaan }}</td>
                        <td>{{ $data->ips_semester_1 }}</td>
                        <td>{{ $data->ips_semester_2 }}</td>
                        <td>{{ $data->ips_semester_3 }}</td>
                        <td>{{ $data->ips_semester_4 }}</td>
                        <td>{{ $data->sks_semester_1 }}</td>
                        <td>{{ $data->sks_semester_2 }}</td>
                        <td>{{ $data->sks_semester_3 }}</td>
                        <td>{{ $data->sks_semester_4 }}</td>
                        <td>{{ $data->matkul_semester_1 }}</td>
                        <td>{{ $data->matkul_semester_2 }}</td>
                        <td>{{ $data->matkul_semester_3 }}</td>
                        <td>{{ $data->matkul_semester_4 }}</td>
                        <td>{{ $data->status_pembayaran }}</td>
                        <td>{{ $data->kelulusan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h1>DATA TRANSFROM</h1>
    <h2>Pada tahap ini data akan diubah menjadi rang yang ditentukan, seperti ipk ditentukan menjadi kurang, gukup, memuaskan, atau sangat memuaskan.</h2>
    <p>Total: {{ $filteredDatasets->count() }}</p>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>

                    <th>Status Pekerjaan</th>
                    <th>IPK Kategori</th>
                    <th>Total SKS Lulus</th>
                    <th>Total Matkul Lulus</th>
                    <th>Status Pembayaran</th>
                    <th>Kelulusan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cleanedDatasets as $data)
                    <tr>
                        <!-- Manually defining data rows -->

                        <td>{{ $data->status_pekerjaan }}</td>
                        <td>
                            @php
                                $rata_ipk = ($data->ips_semester_1 + $data->ips_semester_2 + $data->ips_semester_3 + $data->ips_semester_4) / 4;
                            @endphp
                        
                            @if($rata_ipk < 2.00)
                                Kurang
                            @elseif($rata_ipk >= 2.00 && $rata_ipk < 2.50)
                                Cukup
                            @elseif($rata_ipk >= 2.50 && $rata_ipk < 3.00)
                                Baik
                            @elseif($rata_ipk >= 3.00 && $rata_ipk < 3.50)
                                Memuaskan
                            @else
                                Sangat Memuaskan
                            @endif
                        </td>
                                                <td>{{ $data->sks_semester_1 + $data->sks_semester_2 + $data->sks_semester_3 + $data->sks_semester_4 }}</td>
                        <td>{{ $data->matkul_semester_1 + $data->matkul_semester_2 + $data->matkul_semester_3 + $data->matkul_semester_4 }}</td>
                        <td>{{ $data->status_pembayaran }}</td>
                        <td>{{ $data->kelulusan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
