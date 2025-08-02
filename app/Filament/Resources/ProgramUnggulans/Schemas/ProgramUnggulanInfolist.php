<?php

namespace App\Filament\Resources\ProgramUnggulans\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProgramUnggulanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('slug'),
                IconEntry::make('visible')
                    ->boolean(),
                TextEntry::make('mulai_tahun'),
                TextEntry::make('end_tahun'),
                IconEntry::make('expired')
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
