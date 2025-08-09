<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\SubKegiatanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSubKegiatan extends EditRecord
{
    protected static string $resource = SubKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
