<?php

namespace App\Filament\Resources\Apbds\Pages;

use App\Filament\Resources\Apbds\ApbdResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApbds extends ListRecords
{
    protected static string $resource = ApbdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
