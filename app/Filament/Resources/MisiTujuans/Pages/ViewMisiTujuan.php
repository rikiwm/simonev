<?php

namespace App\Filament\Resources\MisiTujuans\Pages;

use App\Filament\Resources\MisiTujuans\MisiTujuanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMisiTujuan extends ViewRecord
{
    protected static string $resource = MisiTujuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
