<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\SubKegiatanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubKegiatan extends ViewRecord
{
    protected static string $resource = SubKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
