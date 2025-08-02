<?php

namespace App\Filament\Resources\ProgramUnggulans\Pages;

use App\Filament\Resources\ProgramUnggulans\ProgramUnggulanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProgramUnggulan extends EditRecord
{
    protected static string $resource = ProgramUnggulanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
