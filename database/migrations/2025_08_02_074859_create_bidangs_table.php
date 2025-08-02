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
        Schema::create('bidangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('urusan_id')->nullable();
            $table->string('kd_urusan_str')->nullable();
            $table->string('kode_bidang')->nullable();
            $table->string('name_bidang')->nullable()->index();
            $table->string('short_name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description_bidang')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidangs');
    }
};
