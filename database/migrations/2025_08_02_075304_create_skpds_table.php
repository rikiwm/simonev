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
        Schema::create('skpds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kd_satker')->nullable();
            $table->text('kd_satker_str')->nullable();
            $table->text('kd_satker_str_lokal')->nullable();
            $table->string('name_satker')->nullable();
            $table->string('short_name_satker')->nullable();
            $table->string('asisten')->nullable();
            $table->string('nama_asisten')->nullable();
            $table->longText('alamat')->nullable();
            $table->string('telepon')->nullable();
            $table->text('fax')->nullable();
            $table->integer('kodepos')->nullable();
            $table->string('status_satker')->nullable();
            $table->text('ket_satker')->nullable();
            $table->string('jenis_satker')->nullable();
            $table->string('kd_klpd')->nullable();
            $table->string('nama_klpd')->nullable();
            $table->string('jenis_klpd')->nullable();
            $table->string('kode_eselon')->nullable();
            $table->string('nama_eselon')->nullable();
            $table->string('tahun')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpds');
    }
};
