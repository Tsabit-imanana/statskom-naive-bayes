<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'ips', 'sks_lulus', 'mata_kuliah_lulus', 'prediksi'
    ];
}
