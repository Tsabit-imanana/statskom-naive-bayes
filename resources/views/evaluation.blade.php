{{-- resources/views/evaluation.blade.php --}}
@extends('layouts.app') {{-- Sesuaikan jika menggunakan layout tertentu --}}

@section('content')
    <div class="container1">

        {{-- Data Training --}}
        <h1>Training Data</h1>
        <h2>Data traning merupakan data yang akan untuk algoritman naive bayes mempelajari data untuk membuat keputusan. Total data traning adalah 30 data.</h2>
        <p><strong>Total Data: {{ $trainingData->count() }}</strong></p> {{-- Menampilkan total data training --}}
        <div class="table-container">
            @if($trainingData->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status Pekerjaan</th>
                            <th>IPS Semester 1</th>
                            <th>IPS Semester 2</th>
                            <th>IPS Semester 3</th>
                            <th>IPS Semester 4</th>
                            <th>SKS Semester 1</th>
                            <th>SKS Semester 2</th>
                            <th>SKS Semester 3</th>
                            <th>SKS Semester 4</th>
                            <th>Status Pembayaran</th>
                            <th>Kelulusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainingData as $data)
                            <tr>
                                <td>{{ $data['nama'] }}</td>
                                <td>{{ $data['status_pekerjaan'] }}</td>
                                <td>{{ $data['ips_semester_1'] }}</td>
                                <td>{{ $data['ips_semester_2'] }}</td>
                                <td>{{ $data['ips_semester_3'] }}</td>
                                <td>{{ $data['ips_semester_4'] }}</td>
                                <td>{{ $data['sks_semester_1'] }}</td>
                                <td>{{ $data['sks_semester_2'] }}</td>
                                <td>{{ $data['sks_semester_3'] }}</td>
                                <td>{{ $data['sks_semester_4'] }}</td>
                                <td>{{ $data['status_pembayaran'] }}</td>
                                <td>{{ $data['kelulusan'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No training data available.</p>
            @endif
        </div>

    </div>
    <div class="container2">
               {{-- Data Testing --}}
               <h1>Testing Data</h1>   
               <h2>Data testing merupakan data yang akan melakukan uji penggunaan algoritman naive bayes untuk membuat keputusan. Total data testing adalah 29 data.</h2>
               <p><strong>Total Data: {{ $testingData->count() }}</strong></p> {{-- Menampilkan total data testing --}}
               <div class="table-container">
                   @if($testingData->isNotEmpty())
                       <table>
                           <thead>
                               <tr>
                                   <th>Nama</th>
                                   <th>Status Pekerjaan</th>
                                   <th>IPS Semester 1</th>
                                   <th>IPS Semester 2</th>
                                   <th>IPS Semester 3</th>
                                   <th>IPS Semester 4</th>
                                   <th>SKS Semester 1</th>
                                   <th>SKS Semester 2</th>
                                   <th>SKS Semester 3</th>
                                   <th>SKS Semester 4</th>
                                   <th>Status Pembayaran</th>
                                   <th>Kelulusan</th>
                               </tr>
                           </thead>
                           <tbody>
                               @foreach ($testingData as $data)
                                   <tr>
                                       <td>{{ $data['nama'] }}</td>
                                       <td>{{ $data['status_pekerjaan'] }}</td>
                                       <td>{{ $data['ips_semester_1'] }}</td>
                                       <td>{{ $data['ips_semester_2'] }}</td>
                                       <td>{{ $data['ips_semester_3'] }}</td>
                                       <td>{{ $data['ips_semester_4'] }}</td>
                                       <td>{{ $data['sks_semester_1'] }}</td>
                                       <td>{{ $data['sks_semester_2'] }}</td>
                                       <td>{{ $data['sks_semester_3'] }}</td>
                                       <td>{{ $data['sks_semester_4'] }}</td>
                                       <td>{{ $data['status_pembayaran'] }}</td>
                                       <td>{{ $data['kelulusan'] }}</td>
                                   </tr>
                               @endforeach
                           </tbody>
                       </table>
                   @else
                       <p>No testing data available.</p>
                   @endif
               </div>
    </div>

    {{-- CSS langsung di dalam file --}}
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
    position: sticky; /* Membuat header tetap berada di atas */
    top: 0; /* Tetapkan posisi sticky di bagian atas */
    background-color: #777676 !important; /* Warna latar header */
    color: #FFE6CD !important; /* Warna teks header */
    font-family: 'inter';
    z-index: 2; /* Pastikan header berada di atas isi tabel */
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
            background-color: #F5844A;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
        }

        .container2 {
            background-color: #FFE6CD;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
        }

        .container3 {
            background-color: #FFE6CD;
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
            color: #273747;
            font-size: 30px;
            /* text-shadow: 2px 3px 3px rgba(54, 49, 49, 0.4); */
            font-weight: bold;
            /* font-family: 'inter'; */
        }
        h1{
            font-size: 80px;
            color :#01757A;
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
@endsection
