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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_anggaran')->nullable();
            $table->string('kd_klpd')->nullable();
            $table->foreignId('kd_satker')->nullable();
            $table->bigInteger('kd_program')->nullable();
            $table->string('kd_program_str')->nullable();
            $table->text('nama_program')->nullable();
            $table->bigInteger('pagu_program')->nullable();
            $table->bigInteger('pagu_program_perubahan')->nullable();
            $table->string('kd_program_lokal')->nullable();
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
        Schema::dropIfExists('programs');
    }
};
