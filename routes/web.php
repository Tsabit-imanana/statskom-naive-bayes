<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\ProbabilityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman utama
Route::get('/', [DatasetController::class, 'home'])->name('home');

// Rute untuk DatasetController
Route::prefix('dataset')->group(function () {
    Route::get('/', [DatasetController::class, 'dataset'])->name('dataset.index');
    Route::get('/calculation', [DatasetController::class, 'calculation'])->name('dataset.calculation');
    Route::get('/probabilities', [ProbabilityController::class, 'probabilities'])->name('dataset.probabilities');
    Route::get('/evaluation', [DatasetController::class, 'evaluation'])->name('dataset.evaluation');

    // Menambahkan route untuk prediksi kelulusan
    Route::get('/predict', [PrediksiController::class, 'showPredictionForm'])->name('dataset.predict');
    Route::post('/predict', [PrediksiController::class, 'predict'])->name('dataset.predict.submit');
});


// Rute untuk PrediksiController
Route::prefix('prediksi')->group(function () {
    Route::get('/', [PrediksiController::class, 'index'])->name('prediksi.index');
    Route::get('/form', [PrediksiController::class, 'showForm'])->name('predict.form');
    Route::post('/process', [PrediksiController::class, 'processPrediction'])->name('predict.process');
});
