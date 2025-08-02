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
        Schema::create('urusans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_urusan')->nullable();
            $table->string('name_urusan')->nullable()->index();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('urusans');
    }
};
