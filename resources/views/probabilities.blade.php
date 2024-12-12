@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tabel Probabilitas Naive Bayes</h2>

    {{-- Tabel Status Pekerjaan --}}
    <h3>Probabilitas merupakan peluang data tersebut muncul berapa kali dengan hasil tepat waktu atau tidak tepat waktu.</h3>
    <h3>Status Pekerjaan</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribut</th>
                <th>Parameter</th>
                <th>Jumlah Lulus (Pembilang)</th>
                <th>Jumlah Tidak Lulus (Pembilang)</th>
                <th>Probabilitas Lulus</th>
                <th>Probabilitas Tidak Lulus</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($probabilities['Status Pekerjaan']))
                @foreach ($probabilities['Status Pekerjaan'] as $parameter => $values)
                    <tr>
                        <td>{{ $loop->first ? 'Status Pekerjaan' : '' }}</td>
                        <td>{{ $parameter }}</td>
                        <td>{{ $values['Lulus'] }}</td>
                        <td>{{ $values['Tidak Lulus'] }}</td>
                        <td>{{ number_format($values['Lulus'] / $totalLulus, 10) }}</td>
                        <td>{{ number_format($values['Tidak Lulus'] / $totalTidakLulus, 10) }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Data Status Pekerjaan tidak tersedia.</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Tabel IPK --}}
    <h3>IPK</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribut</th>
                <th>Parameter</th>
                <th>Jumlah Lulus (Pembilang)</th>
                <th>Jumlah Tidak Lulus (Pembilang)</th>
                <th>Probabilitas Lulus</th>
                <th>Probabilitas Tidak Lulus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($probabilities['IPK'] as $category => $values)
                <tr>
                    <td>{{ $loop->first ? 'IPK' : '' }}</td>
                    <td>{{ $category }}</td>
                    <td>{{ $values['Lulus'] }}</td>
                    <td>{{ $values['Tidak Lulus'] }}</td>
                    <td>{{ number_format($values['Lulus'] / $totalLulus, 10) }}</td>
                    <td>{{ number_format($values['Tidak Lulus'] / $totalTidakLulus, 10) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Tabel Total SKS Lulus --}}
    <h3>Total SKS Lulus</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribut</th>
                <th>Parameter</th>
                <th>Lulus  </th>
                <th>Tidak Lulus </th>
            </tr>
        </thead>
        <tbody>
            {{-- Baris untuk Mean --}}
            <tr>
                <td rowspan="2">Total SKS Lulus</td>
                <td>Mean</td>
                <td>{{ number_format($sksProbabilities['meanYaHasil'], 2) }}</td>
                <td>{{ number_format($sksProbabilities['meanTidakHasil'], 2) }}</td>
            </tr>
            {{-- Baris untuk StdDev --}}
            <tr>
                <td>Standard Deviation</td>
                <td>{{ number_format($sksProbabilities['stddevYaHasil'], 2) }}</td>
                <td>{{ number_format($sksProbabilities['stddevTidakHasil'], 2) }}</td>
            </tr>
        </tbody>
    </table>
    {{-- Tabel Total SKS Lulus --}}
    <h3>Total Matkul  Lulus</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Attribut</th>
                <th>Parameter</th>
                <th>Lulus  </th>
                <th>Tidak Lulus </th>
            </tr>
        </thead>
        <tbody>
            {{-- Baris untuk Mean --}}
            <tr>
                <td rowspan="2">Total Matkul Lulus</td>
                <td>Mean</td>
                <td>{{ number_format($matkulProbabilities['meanYaHasil'], 2) }}</td>
                <td>{{ number_format($matkulProbabilities['meanTidakHasil'], 2) }}</td>
            </tr>
            {{-- Baris untuk StdDev --}}
            <tr>
                <td>Standard Deviation</td>
                <td>{{ number_format($matkulProbabilities['stddevYaHasil'], 2) }}</td>
                <td>{{ number_format($matkulProbabilities['stddevTidakHasil'], 2) }}</td>
            </tr>
        </tbody>
    </table>



</div>



@endsection
