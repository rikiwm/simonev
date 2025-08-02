<?php

namespace App\Filament\Resources\Urusans\Pages;

use App\Filament\Resources\Urusans\UrusanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUrusans extends ListRecords
{
    protected static string $resource = UrusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
