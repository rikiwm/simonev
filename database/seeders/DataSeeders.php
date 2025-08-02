<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        // $data = json_decode(file_get_contents(base_path('static/master_urusan.json')), true);
        // foreach ($data as $key => $value) {
        //     \App\Models\Urusan::create([
        //         'name_urusan' => $value['nama_layanan'],
        //         'kode_urusan' => $key,
        //          'slug' => $value['slug'],
        //          'tags' => null,
        //          'is_active' => 1
        //     ]);
        // }
        // $data = json_decode(file_get_contents(base_path('static/master_bidang.json')), true);
        // foreach ($data as $key => $value) {
        //     \App\Models\Bidang::create([
        //         'urusan_id' => $value['layanan_id'],
        //         'kd_urusan_str' => $value['layanan_id'],
        //         'kode_bidang' => $value['kode'],
        //         'name_bidang' => $value['nama_bidang'],
        //         'short_name' => Str::chopStart($value['nama_bidang'], 'URUSAN PEMERINTAHAN BIDANG '),
        //         'description_bidang' => $value['description_bidang'],
        //          'slug' => $value['slug'],
        //          'tags' => null,
        //          'is_active' => 1
        //     ]);
        // }


        //  $data = json_decode(file_get_contents(base_path('static/master_misi.json')), true);
        //     foreach ($data as $key => $value) {
        //         \App\Models\Misi::create([
        //             'kode_misi' => $value['code'],
        //             'name_misi' => $value['name'],
        //             'tahun' => $value['tahun'],
        //             'active' => 1
        //         ]);
        //     }

        //        $data2 = json_decode(file_get_contents(base_path('static/master_misi_tujuan.json')), true);
        //     foreach ($data2 as $key => $value) {
        //         \App\Models\MisiTujuan::create([
        //             'kode_tujuan' => $value['code'],
        //             'misi_id' => $value['misi_id'],
        //             'tags' => null,
        //             'name_tujuan' => $value['description'],
        //             'tahun' => $value['tahun'],
        //             'active' => 1ss
        //         ]);
        //     }

            //    $data3 = json_decode(file_get_contents(base_path('static/master_misi_tujuan_sasaran.json')), true);
            // foreach ($data3 as $key => $value) {
            //     \App\Models\MisiTujuanSasaran::create([
            //         'kode_sasaran' =>'0.'.$value['misi_tujuan_id'].'.'.$key+1,
            //         'misi_tujuan_id' => $value['misi_tujuan_id'],
            //         'tags' => null,
            //         'name_sasaran' => $value['description'] ?? $value['indikator_sasaran'],
            //         'tahun' => $value['tahun'],
            //         'active' => 1
            //     ]);
            // }            //
            // $data4 = json_decode(file_get_contents(base_path('static/master_indikator.json')), true);
            // foreach ($data4 as $key => $value) {
            //     \App\Models\Indikator::create([
            //         'parent_id' => $value['parent_id'],
            //         'kode_indikators' => $value['kode'],
            //         'parent_indikator' => $value['parent_indikator'] ??  Str::chopStart($value['nama_indikator'], 'ASPEK '),
            //         'nama_indikator' => $value['nama_indikator'],
            //         'satuan' => $value['satuan'],
            //         'keterangan' => $value['ket'],
            //         'tags_satker' => null,
            //         'tags_sasaran' => $value['tags'],
            //         'sumber_data' => $value['sumber_data'],
            //         'is_active' => $value['is_active'],
            //         'is_canges' => $value['is_canges'],
            //     ]);
            // }
            //
            //  $progul = json_decode(file_get_contents(base_path('static/master_progul.json')), true);
            // foreach ($progul as $key => $value) {
            //     \App\Models\ProgramUnggulan::create([
            //         'name' => $value['name'],
            //         'description' => $value['description'],
            //         'slug' => $value['slug'],
            //         'options' => $value['value'],
            //         'visible' => $value['visible'],
            //         'tags' => null,
            //         'mulai_tahun' => $value['tahun'],
            //         'end_tahun' => $value['tahun']+5,
            //         'expired' => false,
            //     ]);
            // }

            // $sprogul = json_decode(file_get_contents(base_path('static/master_sub_progul.json')), true);
            // foreach ($sprogul as $key => $value) {
            //     \App\Models\ActivasiProgramUnggulan::create([
            //         'name' => $value['name'],
            //         'program_unggulan_id' => $value['progul_id'],
            //         'description' => $value['description'],
            //         'slug' => $value['slug'],
            //         'options' => $value['value'],
            //         'visible' => $value['visible'],
            //         'active' => $value['visible'],
            //         'tags_skpd' => null,
            //         'tags_misi' => null,
            //         'tahun' => $value['tahun'],
            //     ]);
            // }

            // $skpd = json_decode(file_get_contents(base_path('static/master_skpd.json')), true);
            // foreach ($skpd as $key => $value) {
            //     \App\Models\Skpd::create([
            //         'kd_satker' => $value['kd_satker'],
            //         'kd_satker_str' => $value['kd_satker_str'],
            //         'kd_satker_str_lokal' => null,
            //         'name_satker' => $value['nama_satker'],
            //         'short_name_satker' => $value['short_name_satker'],
            //         'asisten' => $value['asisten'],
            //         'nama_asisten' => $value['nama_asisten'],
            //         'alamat' => $value['alamat'],
            //         'telepon' => $value['telepon'],
            //         'fax' => $value['fax'],
            //         'kodepos' => $value['kodepos'],
            //         'status_satker' => $value['status_satker'],
            //         'ket_satker' => $value['ket_satker'],
            //         'jenis_satker' => $value['jenis_satker'],
            //         'kd_klpd' => $value['kd_klpd'],
            //         'nama_klpd' => $value['nama_klpd'],
            //         'jenis_klpd' => $value['jenis_klpd'],
            //         'kode_eselon' => $value['kode_eselon'],
            //         // 'nama_eselon' => $value['nama_eselon'],
            //         'tahun' => now()->year,
            //         'tags' => null,

            //     ]);
            // }

            // $p = json_decode(file_get_contents(base_path('static/program_master.json')), true);
            // $k = json_decode(file_get_contents(base_path('static/kegiatan_master.json')), true);
            // $sk = json_decode(file_get_contents(base_path('static/subkegiatan_master.json')), true);
            $apbd = json_decode(file_get_contents(base_path('static/sipkd.json')), true);
            // foreach ($p as $key => $value) {
            //     \App\Models\Program::create([
            //         'tahun_anggaran' => $value['tahun_anggaran'],
            //         'kd_klpd' => $value['kd_klpd'],
            //         'kd_satker' => $value['kd_satker'],
            //         'kd_program' => $value['kd_program'],
            //         'kd_program_str' => $value['kd_program_str'],
            //         'nama_program' => $value['nama_program'],
            //         'pagu_program' => $value['pagu_program'],
            //         'pagu_program_perubahan' => null,
            //         'kd_program_lokal' => null,
            //         'is_deleted' => $value['is_deleted'],
            //         '_event_date' => $value['_event_date'],
            //     ]);
            // }
            //           foreach ($k as $key => $value) {
            //     \App\Models\Kegiatan::create([
            //         'tahun_anggaran' => $value['tahun_anggaran'],
            //         'kd_klpd' => $value['kd_klpd'],
            //         'kd_satker' => $value['kd_satker'],
            //         'kd_program' => $value['kd_program'],
            //         'kd_kegiatan' => $value['kd_kegiatan'],
            //         'kd_kegiatan_str' => $value['kd_kegiatan_str'],
            //         'nama_kegiatan' => $value['nama_kegiatan'],
            //         'pagu_kegiatan' => $value['pagu_kegiatan'],
            //         'pagu_kegiatan_perubahan' => null,
            //         'kd_kegiatan_lokal' => null,
            //         'is_deleted' => $value['is_deleted'],
            //         '_event_date' => $value['_event_date'],
            //     ]);
            // }
            // foreach ($sk as $key => $value) {
            //     \App\Models\Subkegiatan::create([
            //         'tahun_anggaran' => $value['tahun_anggaran'],
            //         'kd_klpd' => $value['kd_klpd'],
            //         'kd_satker' => $value['kd_satker'],
            //         'kd_program' => $value['kd_program'],
            //         'kd_kegiatan' => $value['kd_kegiatan'],
            //         'kd_subkegiatan' => $value['kd_subkegiatan'],
            //         'kd_subkegiatan_str' => $value['kd_subkegiatan_str'],
            //         'nama_subkegiatan' => $value['nama_subkegiatan'],
            //         'pagu_subkegiatan' => $value['pagu_subkegiatan'],
            //         'pagu_subkegiatan_perubahan' => null,
            //         'kd_subkegiatan_lokal' => null,
            //         'is_deleted' => $value['is_deleted'],
            //         '_event_date' => $value['_event_date'],
            //     ]);
            // }
              foreach ($apbd as $key => $value) {
                \App\Models\Apbd::create([
                    'UNITKEY' => $value['UNITKEY'],
                    'KDUNIT' => $value['KDUNIT'],
                    'SKPD' => $value['SKPD'],
                    'IDURUSAN' => $value['IDURUSAN'],
                    'IDPRGRM' => $value['IDPRGRM'],
                    'KDPRGRM' => $value['KDPRGRM'],
                    'NMPRGRM' => $value['NMPRGRM'],
                    'IDKEG' => $value['IDKEG'],
                    'NUKEG' => $value['NUKEG'],
                    'NMKEG' => $value['NMKEG'],
                    'IDSUBKEG' => $value['IDSUBKEG'],
                    'KDSUBKEG' => $value['KDSUBKEG'],
                    'ANGGARAN' => $value['ANGGARAN'],
                    'REALISASI' => $value['REALISASI'],
                    'tahun_anggaran' => now()->year,
                    'event_date' => now(),

                ]);
            }
    }
}
