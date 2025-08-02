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
        Schema::create('misi_tujuan_sasarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sasaran')->nullable();
            $table->foreignId('misi_tujuan_id')->constrained()->cascadeOnDelete();
            $table->text('name_sasaran')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('active')->default(true);
            $table->year('tahun')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('misi_tujuan_sasarans');
    }
};
