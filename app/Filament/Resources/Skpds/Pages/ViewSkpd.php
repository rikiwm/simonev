<?php

namespace App\Filament\Resources\Skpds\Pages;

use App\Filament\Resources\Skpds\SkpdResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSkpd extends ViewRecord
{
    protected static string $resource = SkpdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
