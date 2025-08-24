<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\SubKegiatanResource;
use App\Models\IndikatorSubKegiatan;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\Size;
use Illuminate\Support\Str;



class ViewSubKegiatan extends ViewRecord
{
    protected static string $resource = SubKegiatanResource::class;
    public $indikatorsubke = [];

    protected function getHeaderActions(): array
    {
     
        return [
            // Action::make('Save')
            //     ->label('Save Indikator')
            //     ->color('secondary')
            //     ->size(Size::ExtraSmall)
            //     ->icon('heroicon-o-plus-circle')
        ];

    }

    public function mount(int|string $record): void
    {
        parent::mount($record);
        $subkegiatan = $this->record->indikatorsubkegiatan ?? $this->record->indikatorsubkegiatanNull;
        $data = null;
    if ($subkegiatan == null) {
        $limit_four_kode = Str::limit($this->record->kd_subkegiatan_str ?? null, 5, '', preserveWords: true);
        $kode = Str::replaceStart($limit_four_kode, 'X.XX.', $this->record->kd_subkegiatan_str);
        $data = IndikatorSubKegiatan::where('kd_subkegiatan', $kode)->get(); // pakai get() -> collection

    } else {
        // bisa collection atau model tergantung relasi
        $data = $this->record->indikatorsubkegiatan ?? $this->record->indikatorsubkegiatanNull;

        // pastikan jadi collection
        if ($data instanceof \Illuminate\Database\Eloquent\Model) {
            $data = collect([$data]);

        }
    }
        // if ($subkegiatan == null) {
        //     $limit_four_kode =  Str::limit($this->record->kd_subkegiatan_str ?? null, 5, '', preserveWords: true);
        //     $kode = Str::replaceStart($limit_four_kode, 'X.XX.', $this->record->kd_subkegiatan_str);
        //     $data = IndikatorSubKegiatan::where('kd_subkegiatan', $kode)->first();
        //     $this->record->setRelations([
        //         'indikatorsubkegiatan' => $data,
        //         'indikatorsubkegiatanNull' => $data,
        //         'kegiatan' => $this->record->kegiatan
        //     ]);
        // } else {
        //     $data =$this->record->indikatorsubkegiatan ?? $this->record->indikatorsubkegiatanNull;
        //     $this->record->setRelations([
        //         'indikatorsubkegiatan' => $this->record->indikatorsubkegiatan,
        //         'indikatorsubkegiatanNull' => $this->record->indikatorsubkegiatanNull,
        //         'kegiatan' => $this->record->kegiatan
        //     ]);
        // }

            // kalau data kosong/null → pakai default 4 triwulan
    if ($data == null) {
        $this->indikatorsubke = collect(range(1, 1))->map(function ($i) {
            return [
                'id'         => null,
                'indikator'  => null,
                'kinerja'    => null, 
                'satuan'     => null,
                'triwulan'   => "Triwulan {$i}",
                'target'     => null,
                'realisasi'  => null,
                'keterangan' => null,
            ];
        })->toArray();
    } else {
        // foreach semua data
        $this->indikatorsubke = $data->map(function ($item, $i) {
            return [
                'id'         => $item->id ?? null,
                'indikator'  => $item->indikator ?? null,
                'kinerja'    => $item->kinerja ?? null, 
                'satuan'     => $item->satuan ?? null,
                'triwulan'   => "Triwulan " . ($i+1),
                'target'     => null,
                'realisasi'  => null,
                'keterangan' => null,
            ];
        })->toArray();
    }
        // dd($this->indikatorsubke);
    
    }


       public function getSubheading(): ?string
    {
        
        return __($this->record->nama_subkegiatan?? '');

    }

    public function getHeading(): string
    {
        return __($this->record->kegiatan?->program?->nama_program);
        // $title = Str::limit($this->record->nama_subkegiatan  ?? '',100, preserveWords:true);
        // return __(Str::upper($title ?? null));

    }
}
