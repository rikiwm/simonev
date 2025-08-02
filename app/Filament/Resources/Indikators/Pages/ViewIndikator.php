<?php

namespace App\Filament\Resources\Indikators\Pages;

use App\Filament\Resources\Indikators\IndikatorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIndikator extends ViewRecord
{
    protected static string $resource = IndikatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
