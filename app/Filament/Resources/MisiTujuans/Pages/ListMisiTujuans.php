<?php

namespace App\Filament\Resources\MisiTujuans\Pages;

use App\Filament\Resources\MisiTujuans\MisiTujuanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMisiTujuans extends ListRecords
{
    protected static string $resource = MisiTujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
