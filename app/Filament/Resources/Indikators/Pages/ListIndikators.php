<?php

namespace App\Filament\Resources\Indikators\Pages;

use App\Filament\Resources\Indikators\IndikatorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIndikators extends ListRecords
{
    protected static string $resource = IndikatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
