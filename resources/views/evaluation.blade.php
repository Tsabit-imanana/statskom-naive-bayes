{{-- resources/views/evaluation.blade.php --}}
@extends('layouts.app') {{-- Sesuaikan jika menggunakan layout tertentu --}}

@section('content')
    <div class="container">
        <h1>Evaluation Results</h1>

        {{-- Data Training --}}
        <div class="table-container">
            <h2>Data traning merupakan data yang akan untuk algoritman naive bayes mempelajari data untuk membuat keputusan. Total data traning adalah 30 data.</h2>
            <h2>Training Data</h2>
            <p><strong>Total Data: {{ $trainingData->count() }}</strong></p> {{-- Menampilkan total data training --}}
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

        {{-- Data Testing --}}
        <div class="table-container">
            <h2>Data testing merupakan data yang akan melakukan uji penggunaan algoritman naive bayes untuk membuat keputusan. Total data testing adalah 29 data.</h2>
            <h2>Testing Data</h2>   
            <p><strong>Total Data: {{ $testingData->count() }}</strong></p> {{-- Menampilkan total data testing --}}
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
@endsection
