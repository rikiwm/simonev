<?php

namespace App\Filament\Resources\Skpds\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SkpdInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kd_satker')
                    ->numeric(),
                TextEntry::make('name_satker'),
                TextEntry::make('short_name_satker'),
                TextEntry::make('asisten'),
                TextEntry::make('nama_asisten'),
                TextEntry::make('telepon'),
                TextEntry::make('kodepos')
                    ->numeric(),
                TextEntry::make('status_satker'),
                TextEntry::make('jenis_satker'),
                TextEntry::make('kd_klpd'),
                TextEntry::make('nama_klpd'),
                TextEntry::make('jenis_klpd'),
                TextEntry::make('kode_eselon'),
                TextEntry::make('nama_eselon'),
                TextEntry::make('tahun'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
