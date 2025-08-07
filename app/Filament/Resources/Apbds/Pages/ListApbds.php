<?php

namespace App\Filament\Resources\Apbds\Pages;

use App\Filament\Resources\Apbds\ApbdResource;
use Filament\Actions\CreateAction;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListApbds extends ListRecords
{
    use ExposesTableToWidgets;
    protected static string $resource = ApbdResource::class;
protected ?string $heading = '';
    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

    

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\Apbds\Widgets\ApbdState::class
        ];
    }
}
