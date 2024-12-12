@extends('layouts.app')

@section('title', 'Home - Naïve Bayes')

@section('content')
    <!-- Konten HTML dari Figma -->
    <div class="home">
        <div class="overlap-wrapper">
            <div class="overlap">
                <div class="overlap-group">
                    <div class="ellipse"></div>
                    <div class="div"></div>
                    <div class="ellipse-2"></div>
                    <div class="ellipse-3"></div>
                    <div class="ellipse-4"></div>
                    <div class="text-wrapper">NAIVE BAYES</div>
                </div>
                <div class="text-wrapper-2">KELOMPOK 3</div>
            </div>
        </div>
    </div>


    <div class="anggota-container">
        <!-- Card 1 -->
        <div class="card-wrapper">
            <div class="card">
                <div class="bg">
                    <img src="{{ asset('images/tsabit_imanana.jpg') }}" alt="Foto Anggota" class="card-image">
                </div>
                <div class="blob-tsabit"></div>
            </div>
            <p class="card-name">Tsabit Imanana</p>
            <p class="card-npm">
                23081010139
            </p>
        </div>
    
        <!-- Card 2 -->
        <div class="card-wrapper">
            <div class="card">
                <div class="bg">
                    <img src="{{ asset('images/rilla.jpg') }}" alt="Foto Anggota" class="card-image">
                </div>
                <div class="blob-rilla"></div>
            </div>
            <p class="card-name">Rilla</p>
            <p class="card-npm">
                23081010206
            </p>
        </div>
    
        <!-- Card 3 -->
        <div class="card-wrapper">
            <div class="card">
                <div class="bg">
                    <img src="{{ asset('images/bila.jpg') }}" alt="Foto Anggota" class="card-image">
                </div>
                <div class="blob-bila"></div>
            </div>
            <p class="card-name">Bila</p>
            <p class="card-npm">
                23081010201
            </p>
        </div>
    </div>
    
    <!-- Bagian Penjelasan (What We Do Here) - Ditambahkan di bawah -->
    <div class="home-penjelasan">
        <div class="overlap-group-wrapper">
            <div class="overlap-group">
                <div class="ellipse"></div>
                <div class="div"></div>
                <img class="image" src="{{ asset('images/penjelasan.png') }}" alt="Image Description" />
                <p class="text-wrapper">WHAT WE DO IN HERE?</p>
                <p class="klasifikasi-untuk">
                    Klasifikasi untuk memprediksi tingkat kelulusan mahasiswa STMIK Widuri&nbsp;&nbsp;menggunakan algoritma
                    Naïve Bayes.
                </p>
            </div>
        </div>
    </div>
@endsection
