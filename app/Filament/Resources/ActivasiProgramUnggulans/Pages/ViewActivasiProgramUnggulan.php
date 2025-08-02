<?php

namespace App\Filament\Resources\ActivasiProgramUnggulans\Pages;

use App\Filament\Resources\ActivasiProgramUnggulans\ActivasiProgramUnggulanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewActivasiProgramUnggulan extends ViewRecord
{
    protected static string $resource = ActivasiProgramUnggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
