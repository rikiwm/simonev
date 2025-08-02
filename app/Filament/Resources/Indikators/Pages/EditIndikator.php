<?php

namespace App\Filament\Resources\Indikators\Pages;

use App\Filament\Resources\Indikators\IndikatorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIndikator extends EditRecord
{
    protected static string $resource = IndikatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
