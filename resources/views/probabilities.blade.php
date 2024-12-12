@extends('layouts.app')

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
        margin: 20px 0;
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
        background-color: #777676 !important;
        color: #FFE6CD !important;
        font-family: 'inter';
    }

    tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.05);
    }

    tr {
        transition: transform 0.2s;
        /* Transisi untuk efek transformasi */
    }

    tr:hover {
        background-color: rgba(255, 255, 255, 0.311);
        transform: scale(1.02);
        /* Sedikit memperbesar baris saat hover */
    }
    .container1 {
        /* background-color: rgba(0, 0, 0, 0.1); */
        background-color: #01757A;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
    }
    .container2 {
        /* background-color: rgba(0, 0, 0, 0.1); */
        background-color: #F6C0A6;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
    }
    .container3 {
        /* background-color: rgba(0, 0, 0, 0.1); */
        background-color: #FFE6CD;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Efek bayangan di sekitar kontainer */
    }

    .orange-heading {
        color: #273747;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        font-size: 70px;
        font-weight: bold;
        /* font-family: 'inter'; */
    }
    .sub {
        color: #273747;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        font-size: 30px;
        font-weight: bold;
        /* font-family: 'inter'; */
    }
    h3 {
        color: #273747;
    }


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
    }



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
    .holder {
    /* display: flex; */
    align-items: center;
    justify-content: center;
    width: 300px; /* Sesuaikan dengan kebutuhan */
    height: 170px; /* Sesuaikan tinggi, contoh 100% tinggi viewport */
    background-color: transparent; /* Warna latar belakang holder, bisa diubah */
}
.rumusProb {
    margin-left: 650px;
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>
    <div class="container1">
        <h2 class="text-center mb-4 orange-heading">Tabel Probabilitas Naive Bayes</h2>
        <h2 class="text-center mb-4 sub">Probabilitas merupakan peluang data tersebut muncul berapa kali dengan hasil tepat waktu atau tidak tepat waktu.
        </h2>
        <div class="holder">
            <img src="{{ asset('images/rumus_prob.png') }}" alt="" class="rumusProb">
        </div>
       

        {{-- Tabel Status Pekerjaan --}}
        <h3>Probabilitas Status Pekerjaan</h3>
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


    
    </div>
    <div class="container2">
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
                            <th>Lulus</th>
                            <th>Tidak Lulus</th>
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
    </div>
    <div class="container3">
                {{-- Tabel Total Matkul Lulus --}}
                <h3>Total Matkul Lulus</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Attribut</th>
                            <th>Parameter</th>
                            <th>Lulus</th>
                            <th>Tidak Lulus</th>
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
                
               {{-- Tabel Probabilitas Pembayaran --}}
<h3>Probabilitas Pembayaran</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Attribut</th>
            <th>Parameter</th>
            <th>Lulus</th>
            <th>Tidak Lulus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($probabilities['Status Pembayaran'] as $status => $counts)
            <tr>
                @if ($loop->first)
                    <td rowspan="{{ count($probabilities['Status Pembayaran']) }}">Pembayaran</td>
                @endif
                <td>{{ $status }}</td>
                <td>{{ $counts['Lulus'] }}</td>
                <td>{{ $counts['Tidak Lulus'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

    </div>
@endsection
