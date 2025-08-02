<?php

namespace App\Filament\Resources\Indikators\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IndikatorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('parent_id')
                    ->numeric(),
                TextEntry::make('satuan'),
                TextEntry::make('sumber_data'),
                IconEntry::make('is_active')
                    ->boolean(),
                IconEntry::make('is_canges')
                    ->boolean(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
