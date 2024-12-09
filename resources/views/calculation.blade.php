@extends('layouts.app')

@section('title', 'Naïve Bayes Calculation')

@section('content')
    <h1>Naïve Bayes Simulation</h1>

    <h2>Confusion Matrix</h2>
    <table border="1" cellspacing="0" cellpadding="5" style="text-align: center; margin: auto; border-collapse: collapse; width: 50%;">
        <caption style="font-weight: bold; margin-bottom: 10px;">Tabel 5. Hasil Confusion Matrix</caption>
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

    <table border="0" cellspacing="5" cellpadding="5" style="margin: auto; text-align: left; width: 50%; margin-top: 20px;">
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
@endsection
