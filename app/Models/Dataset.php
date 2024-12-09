<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_pekerjaan',
        'ipk_kategori',
        'total_sks_lulus',
        'total_mata_kuliah_lulus',
        'status_pembayaran',
        'kelulusan',
    ];
}
