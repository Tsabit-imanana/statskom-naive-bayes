<!-- resources/views/dataset.blade.php -->
@extends('layouts.app')

@section('title', 'Dataset - Naïve Bayes')

@section('content')
    <h1>Dataset Mentah</h1>
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

    <h2>Data Bersih Setelah Preprocessing</h2>
    <p>Total: {{ $cleanedDatasets->count() }}</p>
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
                @foreach ($cleanedDatasets as $data)
                    <tr>
                        @foreach ($columns as $column)
                            <td>{{ $data->$column }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2>Data Setelah Eliminasi Missing Value</h2>
    <p>Total: {{ $filteredDatasets->count() }}</p>
    <div class="table-container">
        <table class="table table-bordered">
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
                @foreach ($filteredDatasets as $data)
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
    </div>
@endsection
