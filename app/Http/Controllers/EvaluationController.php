<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index()
    {
        // Logika evaluasi akan ditambahkan di sini
        return view('evaluation.index');
    }
}
