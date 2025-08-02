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
        Schema::create('program_unggulans', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->longText('description')->nullable();
            $table->string('slug')->nullable();
            $table->json('tags')->nullable();
            $table->longText('options')->nullable();
            $table->boolean('visible')->default(true);
            $table->year('mulai_tahun')->nullable();
            $table->year('end_tahun')->nullable();
            $table->boolean('expired')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_unggulans');
    }
};
