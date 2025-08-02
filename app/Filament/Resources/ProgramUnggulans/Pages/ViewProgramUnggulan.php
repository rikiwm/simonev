<?php

namespace App\Filament\Resources\ProgramUnggulans\Pages;

use App\Filament\Resources\ProgramUnggulans\ProgramUnggulanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProgramUnggulan extends ViewRecord
{
    protected static string $resource = ProgramUnggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
