<?php

namespace App\Filament\Resources\Urusans\Pages;

use App\Filament\Resources\Urusans\UrusanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUrusan extends ViewRecord
{
    protected static string $resource = UrusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
