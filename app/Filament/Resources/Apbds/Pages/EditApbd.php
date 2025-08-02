<?php

namespace App\Filament\Resources\Apbds\Pages;

use App\Filament\Resources\Apbds\ApbdResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditApbd extends EditRecord
{
    protected static string $resource = ApbdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
