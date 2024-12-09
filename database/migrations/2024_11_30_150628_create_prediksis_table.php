<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrediksisTable extends Migration
{
    public function up()
    {
        Schema::create('prediksis', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('program_studi');
            $table->text('jenis_kelamin'); // Menggunakan text, karena tidak perlu enum
            $table->text('status_pekerjaan'); // Menggunakan text, karena tidak perlu enum
            $table->text('ipk_kategori'); // Menggunakan text, karena tidak perlu enum
            $table->integer('total_sks_lulus');
            $table->integer('total_mata_kuliah_lulus');
            $table->text('status_pembayaran'); // Menggunakan text, karena status pembayaran berbentuk kalimat
            $table->text('kelulusan'); // Menggunakan text, karena kelulusan berbentuk kalimat
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prediksis');
    }
}
