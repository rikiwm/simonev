<?php

namespace App\Filament\Resources\ActivasiProgramUnggulans\Pages;

use App\Filament\Resources\ActivasiProgramUnggulans\ActivasiProgramUnggulanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListActivasiProgramUnggulans extends ListRecords
{
    protected static string $resource = ActivasiProgramUnggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
