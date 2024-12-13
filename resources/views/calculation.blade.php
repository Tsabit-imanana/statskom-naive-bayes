@extends('layouts.app')

@section('title', 'Naïve Bayes Calculation')

@section('content')
<style>
    /* Full Page Styling */
    body {
        margin: 0;
        padding: 0;
        background-color: #3E2922;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    /* Main Content Styling */
    .content {
        width: 80%;
        max-width: 1200px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    header {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    p {
        font-size: 1rem;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #fff;
    }

    table caption {
        font-weight: bold;
        margin-bottom: 10px;
    }

    table th, table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
    }

    table th {
        background-color: #B6ACAD;
        color: #fff;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .metrics {
        text-align: left;
        margin-top: 20px;
        width: 100%;
    }

    .metrics td {
        padding: 5px;
    }

    .metrics strong {
        font-weight: bold;
    }

    /* Image Row Styling */
    .image-row {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 20px 0;
    }

    .image-row img {
        max-width: 200px;
        max-height: 200px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<section class="content">
    <header>Naïve Bayes Simulation</header>
    <p>Berikut adalah hasil simulasi Naïve Bayes beserta evaluasi performanya.</p>

    <div class="image-row">
        <img src="{{ asset('images/accuray.png') }}" alt="Accuracy">
        <img src="{{ asset('images/precision.png') }}" alt="Precision">
        <img src="{{ asset('images/recall.png') }}" alt="Recall">
        {{-- <img src="{{ asset('images/other.png') }}" alt="Other Metric"> --}}
    </div>

    <h2 style="text-align: center;">Confusion Matrix</h2>
    <table>
        <thead>
            <tr>
                <th></th>
                <th colspan="2">True</th>
            </tr>
            <tr>
                <th></th>
                <th>Lulus</th>
                <th>Tidak Lulus</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pred. Lulus</td>
                <td>{{ $confusionMatrix['Lulus']['Lulus'] }}</td>
                <td>{{ $confusionMatrix['Tidak Lulus']['Lulus'] }}</td>
            </tr>
            <tr>
                <td>Pred. Tidak Lulus</td>
                <td>{{ $confusionMatrix['Lulus']['Tidak Lulus'] }}</td>
                <td>{{ $confusionMatrix['Tidak Lulus']['Tidak Lulus'] }}</td>
            </tr>
        </tbody>
    </table>

    <table class="metrics">
        <tr>
            <td><strong>Accuracy:</strong></td>
            <td>{{ number_format($accuracy * 100, 2) }}%</td>
        </tr>
        <tr>
            <td><strong>Precision:</strong></td>
            <td>{{ number_format($precision * 100, 2) }}%</td>
        </tr>
        <tr>
            <td><strong>Recall:</strong></td>
            <td>{{ number_format($recall * 100, 2) }}%</td>
        </tr>
    </table>
</section>
@endsection