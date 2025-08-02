<?php

namespace App\Filament\Resources\Apbds\Pages;

use App\Filament\Resources\Apbds\ApbdResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewApbd extends ViewRecord
{
    protected static string $resource = ApbdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
