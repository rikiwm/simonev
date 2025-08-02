<?php

namespace App\Filament\Resources\Bidangs\Pages;

use App\Filament\Resources\Bidangs\BidangResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBidang extends EditRecord
{
    protected static string $resource = BidangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
