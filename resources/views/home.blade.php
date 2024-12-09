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

    <!-- Bagian Anggota (Our Team) -->
    <div class="home-anggota">
        <div class="overlap-group-wrapper">
            <div class="overlap-group">
                <!-- Team Members with Photos and Names -->
                <div class="team-member">
                    <div class="circle-wrapper">
                        <img class="anggota" src="{{ asset('images/rilla.png') }}" alt="Nadiyah Myrilla" />
                    </div>
                    <!-- Member's Name and ID Below the Circle -->
                    <div class="member-name">Nadiyah Myrilla</div>
                    <div class="member-id">23081010206</div>
                </div>
    
                <div class="team-member">
                    <div class="circle-wrapper">
                        <img class="img" src="{{ asset('images/nuha.png') }}" alt="Salsabila Nuha" />
                    </div>
                    <!-- Member's Name and ID Below the Circle -->
                    <div class="member-name">Salsabila Nuha</div>
                    <div class="member-id">23081010201</div>
                </div>
    
                <div class="team-member">
                    <div class="circle-wrapper">
                        <img class="anggota-2" src="{{ asset('images/tsabit.png') }}" alt="Tsabit Imanana" />
                    </div>
                    <!-- Member's Name and ID Below the Circle -->
                    <div class="member-name">Tsabit Imanana</div>
                    <div class="member-id">23081010169</div>
                </div>
            </div>
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
