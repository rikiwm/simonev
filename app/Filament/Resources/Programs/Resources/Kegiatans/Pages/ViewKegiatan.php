<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\KegiatanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKegiatan extends ViewRecord
{
    protected static string $resource = KegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
