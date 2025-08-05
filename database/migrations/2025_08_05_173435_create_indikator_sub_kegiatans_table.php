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
        Schema::create('indikator_sub_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('kd_bidang', 20);
            $table->string('kd_program', 20);
            $table->string('kd_kegiatan', 20);
            $table->string('kd_subkegiatan', 20);
            $table->text('kinerja', 255);
            $table->text('indikator', 255);
            $table->string('satuan', 50);
            $table->text('tag')->nullable();
            $table->text('definisi_operasional')->nullable();
            $table->unsignedBigInteger('satker_id')->nullable();
            $table->string('pelaksana', 100)->nullable();
            $table->string('spm', 50)->nullable();
            $table->string('jenis', 50)->nullable();
            $table->string('subkeg_before', 255)->nullable();
            $table->text('ket_subkeg_before', 255)->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_sub_kegiatans');
    }
};
