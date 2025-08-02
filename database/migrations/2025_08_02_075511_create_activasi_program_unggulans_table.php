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
        Schema::create('activasi_program_unggulans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_unggulan_id')->constrained()->cascadeOnDelete();
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('slug')->nullable();
            $table->longText('options')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('active')->default(true);
            $table->year('tahun')->nullable();
            $table->json('tags_skpd')->nullable();
            $table->json('tags_misi')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activasi_program_unggulans');
    }
};
