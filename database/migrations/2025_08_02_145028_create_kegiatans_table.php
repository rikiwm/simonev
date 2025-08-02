<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_anggaran')->nullable();
            $table->string('kd_klpd')->nullable();
            $table->foreignId('kd_satker')->nullable();
            $table->foreignId('kd_program')->nullable();
            $table->bigInteger('kd_kegiatan')->nullable();
            $table->string('kd_kegiatan_str')->nullable();
            $table->text('nama_kegiatan')->nullable();
            $table->bigInteger('pagu_kegiatan')->nullable();
            $table->bigInteger('pagu_kegiatan_perubahan')->nullable();
            $table->string('kd_kegiatan_lokal')->nullable();
            $table->boolean('is_deleted')->default(false)->nullable();
            $table->date('_event_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
