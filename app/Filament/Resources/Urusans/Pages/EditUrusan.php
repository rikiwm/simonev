<?php

namespace App\Filament\Resources\Urusans\Pages;

use App\Filament\Resources\Urusans\UrusanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUrusan extends EditRecord
{
    protected static string $resource = UrusanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
