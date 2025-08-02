<?php

namespace App\Filament\Resources\MisiTujuanSasarans\Pages;

use App\Filament\Resources\MisiTujuanSasarans\MisiTujuanSasaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMisiTujuanSasarans extends ListRecords
{
    protected static string $resource = MisiTujuanSasaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
