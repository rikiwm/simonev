<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\SubKegiatanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Str;



class ViewSubKegiatan extends ViewRecord
{
    protected static string $resource = SubKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
        ];
    }

    //    public function getSubheading(): ?string
    // {
    //     // dd($this->record);
    //     // $sub = Str::limit($this->record->nama_subkegiatan,100, preserveWords:true);
    //     // return __($sub);
    //     // return __($this->record->kegiatan?->nama_kegiatan ?? '');

    // }

    public function getHeading(): string
    {   
        return __($this->record->kegiatan?->program?->nama_program);
        // return __($this->record->nama_subkegiatan ?? '');

    }
}
