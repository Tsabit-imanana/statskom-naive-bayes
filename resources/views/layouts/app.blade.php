<!DOCTYPE html>
<html lang="en">
<!-- app.blade.php -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Naive Bayes App')</title>

    <!-- Mengimpor CSS untuk bottom bar -->
    <link rel="stylesheet" href="{{ asset('css/bottom-bar.css') }}">

    <!-- Mengimpor CSS untuk tabel -->
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <!-- Mengimpor CSS khusus untuk halaman home -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- CSS lainnya jika ada -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/predict.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/uiverse.css') }}">


</head>

<body>
    <div class="content">
        <!-- Konten di dalam 80% lebar layar dengan margin auto untuk center alignment -->
        @yield('content')
        
<br>
<br>
<br>
<br>
    </div>

    <div class="bottom-bar inactive" id="bottomBar">
        <ul>
            <li>
                <a href="{{ route('home') }}">
                    <!-- Logo Home -->
                    <img src="{{ asset('images/logo-home.svg') }}" alt="Home Logo" class="bottom-bar-icon">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('dataset.index') }}">
                    <!-- Logo Dataset -->
                    <img src="{{ asset('images/logo-dataset.svg') }}" alt="Dataset Logo" class="bottom-bar-icon">
                    Dataset
                </a>
            </li>
            <li>
                <a href="{{ route('dataset.evaluation') }}">
                    <!-- Logo Evaluation -->
                    <img src="{{ asset('images/logo-evaluation.svg') }}" alt="Evaluation Logo" class="bottom-bar-icon">
                    Evaluation
                </a>
            </li>
            <li>
                <a href="{{ route('dataset.probabilities') }}">
                    <!-- Logo Probabilities -->
                    <img src="{{ asset('images/logo-probabilities.svg') }}" alt="Probabilities Logo" class="bottom-bar-icon">
                    Probabilities
                </a>
            </li>
            <li>    
                <a href="{{ route('dataset.calculation') }}">
                    <!-- Logo Accuracy -->
                    <img src="{{ asset('images/logo-accuracy.svg') }}" alt="Accuracy Logo" class="bottom-bar-icon">
                    Accuracy
                </a>
            </li>
            <li>
                <a href="{{ route('dataset.predict') }}">
                    <!-- Logo Validation -->
                    <img src="{{ asset('images/logo-validation.svg') }}" alt="Validation Logo" class="bottom-bar-icon">
                    Validation
                </a>
            </li>
        </ul>
    </div>
    
    <!-- JavaScript lainnya -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bottom-bar.js') }}"></script>
</body>
</html>
