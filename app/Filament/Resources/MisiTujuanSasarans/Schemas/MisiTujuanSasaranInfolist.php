<?php

namespace App\Filament\Resources\MisiTujuanSasarans\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MisiTujuanSasaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_sasaran'),
                TextEntry::make('misi_tujuan_id')
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
