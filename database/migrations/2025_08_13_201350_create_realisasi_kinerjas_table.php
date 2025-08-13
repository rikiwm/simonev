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
        Schema::create('realisasi_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_sub_kegiatan_id')->constrained('indikator_sub_kegiatans');
            $table->foreignId('skpds_id');
            $table->string('kodeindikator');
            $table->foreignId('kode_type')->nullable();
            $table->string('type_name')->nullable();
            $table->string('jenis');
            $table->bigInteger('target')->nullable();
            $table->bigInteger('target_n1')->nullable();
            $table->bigInteger('pagu')->nullable();
            $table->bigInteger('pagu_n1')->nullable();
            $table->bigInteger('real_p_t1')->nullable();
            $table->bigInteger('real_p_t2')->nullable();
            $table->bigInteger('real_p_t3')->nullable();
            $table->bigInteger('real_p_t4')->nullable();
            $table->bigInteger('real_p_final')->nullable();
            $table->bigInteger('pagu_p_t1')->nullable();
            $table->bigInteger('pagu_p_t2')->nullable();
            $table->bigInteger('pagu_p_t3')->nullable();
            $table->bigInteger('pagu_p_t4')->nullable();
            $table->bigInteger('pagu_p_final')->nullable();
            $table->year('tahun_realisasi')->default(now()->format('Y'));
            $table->boolean('is_active')->default(true);
            $table->boolean('is_final_result')->default(false);
            $table->boolean('is_target_equal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_kinerjas');
    }
};
