<?php

namespace App\Filament\Resources\ActivasiProgramUnggulans\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivasiProgramUnggulanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('program_unggulan_id')
                    ->numeric(),
                TextEntry::make('slug'),
                IconEntry::make('visible')
                    ->boolean(),
                IconEntry::make('active')
                    ->boolean(),
                TextEntry::make('tahun'),
                TextEntry::make('deleted_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
