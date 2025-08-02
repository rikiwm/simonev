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
        Schema::create('indikators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('indikators')->nullOnDelete();
            $table->text('kode_indikators')->nullable();
            $table->text('parent_indikator')->nullable(); // disarankan rename agar tidak ada underscore akhir
            $table->text('nama_indikator')->nullable();
            $table->string('satuan')->nullable();
            $table->longText('keterangan')->nullable();
            $table->json('tags_satker')->nullable();
            $table->json('tags_sasaran')->nullable();
            $table->string('sumber_data')->nullable()->default('RPJMD');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_canges')->default(false)->comment('data perubahan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikators');
    }
};
