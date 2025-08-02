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
        Schema::create('apbds', function (Blueprint $table) {
            $table->id();
            $table->string('UNITKEY')->nullable();
            $table->string('KDUNIT')->nullable();
            $table->string('SKPD')->nullable();
            $table->string('IDURUSAN')->nullable();
            $table->string('IDPRGRM')->nullable();
            $table->string('KDPRGRM')->nullable();
            $table->string('NMPRGRM')->nullable();
            $table->string('IDKEG')->nullable();
            $table->string('NUKEG')->nullable();
            $table->text('NMKEG')->nullable();
            $table->string('IDSUBKEG')->nullable();
            $table->string('KDSUBKEG')->nullable();
            $table->string('ANGGARAN')->nullable();
            $table->string('REALISASI')->nullable();
            $table->year('tahun_anggaran')->nullable();
            $table->date('event_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbds');
    }
};
