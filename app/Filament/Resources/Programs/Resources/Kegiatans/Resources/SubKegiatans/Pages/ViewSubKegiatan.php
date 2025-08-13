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
        $subkegiatan = $this->record->indikatorsubkegiatan->kd_subkegiatan ?? $this->record->indikatorsubkegiatanNull?->subkeg_before;
        $data = null;
        if ($subkegiatan == null) {
            $limit_four_kode =  Str::limit($this->record->kd_subkegiatan_str ?? null, 5, '', preserveWords: true);
            $kode = Str::replaceStart($limit_four_kode, 'X.XX.', $this->record->kd_subkegiatan_str);
            $data = IndikatorSubKegiatan::where('kd_subkegiatan', $kode)->first();
            $this->record->setRelations([
                'indikatorsubkegiatan' => $data,
                'indikatorsubkegiatanNull' => $data,
                'kegiatan' => $this->record->kegiatan
            ]);
        } else {
            $data =$this->record->indikatorsubkegiatan ?? $this->record->indikatorsubkegiatanNull;
            $this->record->setRelations([
                'indikatorsubkegiatan' => $this->record->indikatorsubkegiatan,
                'indikatorsubkegiatanNull' => $this->record->indikatorsubkegiatanNull,
                'kegiatan' => $this->record->kegiatan
            ]);
        }

        $this->indikatorsubke = collect(range(1, 1))->map(function ($i) use ($data) {
            return [
                'indikator'  => $data->indikator ?? null,
                'satuan'     => $data->satuan ?? null,
                'triwulan'   => "Triwulan {$i}",
                'target'     => null,
                'realisasi'  => null,
                'keterangan' => null,
            ];
        })->toArray();

    }


       public function getSubheading(): ?string
    {
        // dd($this->record);
        // $sub = Str::limit($this->record->nama_subkegiatan,100, preserveWords:true);
        // return __($sub);
        return __($this->record->nama_subkegiatan?? '');

    }

    public function getHeading(): string
    {
        return __($this->record->kegiatan?->program?->nama_program);
        // $title = Str::limit($this->record->nama_subkegiatan  ?? '',100, preserveWords:true);
        // return __(Str::upper($title ?? null));

    }
}
