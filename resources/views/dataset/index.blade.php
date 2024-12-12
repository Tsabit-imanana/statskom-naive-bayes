@extends('layouts.app')

@section('title', 'Dataset - Naïve Bayes')

@section('content')
<style>
    /* Gaya untuk body dengan gradasi */
body {
    margin: 0;
    background: #FFE6CD;
    /* Gradasi warna pada latar belakang body */
}


/* Gaya untuk tabel */
table {
    width: 100%;
    margin: -20px;
    margin-left: -20px;
    border-collapse: collapse;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    backdrop-filter: blur(5px);
    overflow: hidden;
    /* Menghilangkan border tabel */
}

th,
td {
    padding: 12px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.273);
    font-family: 'inter';
    font-weight: bold;
    color: #273747;
}

th {
    position: sticky;
    top: 0; /* Agar header tetap di atas saat scroll */
    background-color: #777676 !important;
    color: #FFE6CD !important;
    font-family: 'inter';
    z-index: 2; /* Membuat th tetap di atas tabel saat scroll */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan untuk memberikan efek header yang menonjol */
}

/* Gaya untuk baris tabel genap */
tr:nth-child(even) {
    background-color: rgba(255, 255, 255, 0.05);
}

/* Transisi efek hover pada baris tabel */
tr {
    transition: transform 0.2s;
    /* Transisi untuk efek transformasi */
}

tr:hover {
    background-color: rgba(255, 255, 255, 0.311);
    transform: scale(1.02);
    /* Sedikit memperbesar baris saat hover */
}

/* Gaya untuk kontainer */
.container1 {
    background-color: #777676;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
}

.container2 {
    background-color: #F6C0A6;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
}

.container3 {
    background-color: #01757A;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
}
.container4 {
    background-color: #F6C0A6;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
}

/* Gaya untuk heading berwarna orange */
.orange-heading {
    color: orange;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    font-size: 70px;
    text-shadow: 2px 3px 3px rgba(54, 49, 49, 0.4);
    font-weight: bold;
    font-family: 'inter';
}

h3 {
    color: #273747;
}

/* Gaya untuk heading h2 */
h2 {
    color: #273747;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    color: #ffffff;
    font-size: 30px;
    text-shadow: 2px 3px 3px rgba(54, 49, 49, 0.4);
    font-weight: bold;
    font-family: 'inter';
}
/* Gaya untuk heading h2 */
h1 {
   font-size: 80px;
   color: #F5844A
}

/* Animasi fadeIn untuk tabel */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
        /* Efek pergeseran ke bawah saat muncul */
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table {
    animation: fadeIn 1s ease;
    /* Menambahkan efek fade-in */
}

/* Gaya untuk kontainer tabel */
.table-container {
    max-height: 400px; /* Menetapkan tinggi kontainer agar scroll dapat berfungsi */
    overflow-y: auto; /* Menambahkan scroll vertikal */
}

</style>


    <div class="container1">
        <h1>DATA MENTAH</h1>
        <h2>Dataset aktivitas kuliah mahasiswa STMIK Widuri angkatan 2021 yang terdiri dari prodi Sistem Informasi sebanyak 27 mahasiswa dan prodi Teknik Informatika sebanyak 34 mahasiswa</h2>
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
    </div>

    <div class="container2">

    <h1>PREPROCESSING</h1>
    <h2>Menghilangkan missing value atau data outlier yang bisa membuat keputusan menjadi tidak akurat.</h2>
    <p>Total: {{ $filteredDatasets->count() }}</p>

    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
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
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->tempat_dan_tanggal_lahir }}</td>
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

</div>

<div class="container3">
    <h1>DATA SELECTION</h1>
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


</div>
<div class="container4">
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

</div>
@endsection
