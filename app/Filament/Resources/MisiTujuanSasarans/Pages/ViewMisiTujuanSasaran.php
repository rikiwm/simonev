<?php

namespace App\Filament\Resources\MisiTujuanSasarans\Pages;

use App\Filament\Resources\MisiTujuanSasarans\MisiTujuanSasaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMisiTujuanSasaran extends ViewRecord
{
    protected static string $resource = MisiTujuanSasaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
