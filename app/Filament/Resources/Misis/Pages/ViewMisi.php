<?php

namespace App\Filament\Resources\Misis\Pages;

use App\Filament\Resources\Misis\MisiResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMisi extends ViewRecord
{
    protected static string $resource = MisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
