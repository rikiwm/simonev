<?php

// 1. Migration: create_pemdas_table.php
Schema::create('pemdas', function (Blueprint $table) {
    $table->id();
    $table->string('kodepemda');
    $table->string('tahun');
    $table->timestamps();
});

// 2. Migration: create_bidangs_table.php
Schema::create('bidangs', function (Blueprint $table) {
    $table->id();
    $table->string('kodebidang');
    $table->string('uraibidang');
    $table->timestamps();
});

// 3. Migration: create_skpds_table.php
Schema::create('skpds', function (Blueprint $table) {
    $table->id();
    $table->string('kodeskpd');
    $table->string('uraiskpd');
    $table->foreignId('pemda_id')->constrained('pemdas');
    $table->foreignId('bidang_id')->constrained('bidangs');
    $table->string('kepalanip')->nullable();
    $table->string('kepalanama')->nullable();
    $table->string('kepalajabatan')->nullable();
    $table->string('kepalapangkat')->nullable();
    $table->string('uraiurusan');
    $table->timestamps();
});

// 4. Migration: create_programs_table.php
Schema::create('programs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('skpd_id')->constrained('skpds');
    $table->foreignId('bidang_id')->constrained('bidangs');
    $table->string('kodeprogram');
    $table->string('uraiprogram');
    $table->timestamps();
});

// 5. Migration: create_program_indikators_table.php
Schema::create('program_indikators', function (Blueprint $table) {
    $table->id();
    $table->foreignId('program_id')->constrained('programs');
    $table->string('kodeindikator');
    $table->string('tolokukur');
    $table->string('satuan');
    $table->string('target')->nullable();
    $table->string('target_n1')->nullable();
    $table->decimal('pagu', 20, 2)->nullable();
    $table->decimal('pagu_n1', 20, 2)->nullable();
    $table->string('real_p1')->nullable();
    $table->string('real_p2')->nullable();
    $table->string('real_p3')->nullable();
    $table->decimal('pagu_p1', 20, 2)->nullable();
    $table->decimal('pagu_p2', 20, 2)->nullable();
    $table->decimal('pagu_p3', 20, 2)->nullable();
    $table->decimal('pagu_p', 20, 2)->nullable();
    $table->timestamps();
});

// 6. Migration: create_kegiatans_table.php
Schema::create('kegiatans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('program_id')->constrained('programs');
    $table->string('kodekegiatan');
    $table->string('uraikegiatan');
    $table->decimal('pagu', 20, 2);
    $table->decimal('pagu_p', 20, 2)->nullable();
    $table->timestamps();
});

// 7. Migration: create_kegiatan_indikators_table.php
Schema::create('kegiatan_indikators', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kegiatan_id')->constrained('kegiatans');
    $table->string('kodeindikator');
    $table->string('jenis');
    $table->string('tolokukur');
    $table->string('satuan');
    $table->string('target')->nullable();
    $table->string('target_n1')->nullable();
    $table->decimal('pagu', 20, 2)->nullable();
    $table->decimal('pagu_n1', 20, 2)->nullable();
    $table->string('real_p1')->nullable();
    $table->string('real_p2')->nullable();
    $table->string('real_p3')->nullable();
    $table->decimal('pagu_p1', 20, 2)->nullable();
    $table->decimal('pagu_p2', 20, 2)->nullable();
    $table->decimal('pagu_p3', 20, 2)->nullable();
    $table->decimal('pagu_p', 20, 2)->nullable();
    $table->timestamps();
});

// 8. Migration: create_subkegiatans_table.php
Schema::create('subkegiatans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kegiatan_id')->constrained('kegiatans');
    $table->string('kodesubkegiatan');
    $table->string('uraisubkegiatan');
    $table->decimal('pagu', 20, 2);
    $table->decimal('pagu_p', 20, 2)->nullable();
    $table->timestamps();
});

// 9. Migration: create_subkegiatan_indikators_table.php
Schema::create('subkegiatan_indikators', function (Blueprint $table) {
    $table->id();
    $table->foreignId('subkegiatan_id')->constrained('subkegiatans');
    $table->string('kodeindikator');
    $table->string('jenis');
    $table->string('tolokukur');
    $table->string('satuan');
    $table->string('target')->nullable();
    $table->string('target_n1')->nullable();
    $table->decimal('pagu', 20, 2)->nullable();
    $table->decimal('pagu_n1', 20, 2)->nullable();
    $table->string('real_p1')->nullable();
    $table->string('real_p2')->nullable();
    $table->string('real_p3')->nullable();
    $table->decimal('pagu_p1', 20, 2)->nullable();
    $table->decimal('pagu_p2', 20, 2)->nullable();
    $table->decimal('pagu_p3', 20, 2)->nullable();
    $table->decimal('pagu_p', 20, 2)->nullable();
    $table->timestamps();
});

// 10. Migration: create_sumber_danas_table.php
Schema::create('sumber_danas', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('kode');
    $table->timestamps();
});

// 11. Migration: create_kegiatan_sumber_dana_table.php
Schema::create('kegiatan_sumber_dana', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kegiatan_id')->constrained('kegiatans');
    $table->foreignId('sumber_dana_id')->constrained('sumber_danas');
    $table->decimal('pagu', 20, 2);
    $table->timestamps();
});

// 12. Migration: create_lokasis_table.php
Schema::create('lokasis', function (Blueprint $table) {
    $table->id();
    $table->string('lokasi');
    $table->string('kodelokasi');
    $table->text('detaillokasi')->nullable();
    $table->timestamps();
});

// 13. Migration: create_kegiatan_lokasis_table.php
Schema::create('kegiatan_lokasis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kegiatan_id')->constrained('kegiatans');
    $table->foreignId('lokasi_id')->constrained('lokasis');
    $table->timestamps();
});

// 14. Migration: create_prioritas_table.php
Schema::create('prioritas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kegiatan_id')->constrained('kegiatans');
    $table->string('prioritas_nasional')->nullable();
    $table->string('prioritas_daerah')->nullable();
    $table->timestamps();
});
