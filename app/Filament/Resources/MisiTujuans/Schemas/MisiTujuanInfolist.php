<?php

namespace App\Filament\Resources\MisiTujuans\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MisiTujuanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_tujuan'),
                TextEntry::make('misi_id')
                    ->numeric(),
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
