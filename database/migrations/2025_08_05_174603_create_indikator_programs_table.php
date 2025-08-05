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
        Schema::create('indikator_programs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->nullable();
            $table->string('bidang', 220)->nullable();
            $table->string('kd_bidang', 20)->nullable();
            $table->string('kd_program', 20)->nullable();
            $table->string('kd_program_str', 20)->nullable();
            $table->string('nama_program', 255)->nullable();
            $table->text('satuan')->nullable();
            $table->text('indikator')->nullable();
            $table->text('definisi')->nullable();
            $table->text('indikator_outcome_canges')->nullable();
            $table->text('indikator_outcome_before')->nullable();
            $table->string('kd_satker', 20)->nullable();
            $table->string('satker', 255)->nullable();
            $table->text('tags')->nullable();
            $table->text('sumber_data')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_canges')->default(0);
        //     	"parent_id" : null,
		// "bidang" : null,
		// "kd_bidang" : null,
		// "nama_program" : "PROGRAM PENDIDIK DAN TENAGA KEPENDIDIKAN",
		// "kd_program" : "2573707",
		// "kd_program_str" : "1.01.04",
		// "indikator_satuan" : null,
		// "indikator_outcome" : "Persentase terlaksananya penataan dan pengelolaan pendidik dan tenaga kependidikan",
		// "indikator_definisi" : null,
		// "indikator_outcome_canges" : null,
		// "indikator_outcome_before" : null,
		// "kd_satker" : "75491",
		// "satker" : "DINAS PENDIDIKAN DAN KEBUDAYAAN",
		// "tags" : null,
		// "sumber_data" : null,
		// "is_active" : 1,
		// "is_canges" : 0,
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_programs');
    }
};
