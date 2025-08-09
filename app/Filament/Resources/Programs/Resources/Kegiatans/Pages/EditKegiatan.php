<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\KegiatanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditKegiatan extends EditRecord
{
    protected static string $resource = KegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
