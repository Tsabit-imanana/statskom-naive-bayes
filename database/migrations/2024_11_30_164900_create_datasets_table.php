<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('tempat_tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('no_telp');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('status_pekerjaan');
            $table->string('program_studi');
            $table->string('kelas');
            $table->decimal('ips_semester_1', 4, 2)->nullable();
            $table->decimal('ips_semester_2', 4, 2)->nullable();
            $table->decimal('ips_semester_3', 4, 2)->nullable();
            $table->decimal('ips_semester_4', 4, 2)->nullable();
            $table->integer('sks_semester_1')->nullable();
            $table->integer('sks_semester_2')->nullable();
            $table->integer('sks_semester_3')->nullable();
            $table->integer('sks_semester_4')->nullable();
            $table->text('matkul_semester_1')->nullable();
            $table->text('matkul_semester_2')->nullable();
            $table->text('matkul_semester_3')->nullable();
            $table->text('matkul_semester_4')->nullable();
            $table->string('status_pembayaran');
            $table->string('kelulusan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasets');
    }
};
