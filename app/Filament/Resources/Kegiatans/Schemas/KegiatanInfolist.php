<?php

namespace App\Filament\Resources\Kegiatans\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KegiatanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tahun_anggaran'),
                TextEntry::make('kd_klpd'),
                TextEntry::make('kd_satker')
                    ->numeric(),
                TextEntry::make('kd_program')
                    ->numeric(),
                TextEntry::make('kd_kegiatan')
                    ->numeric(),
                TextEntry::make('kd_kegiatan_str'),
                TextEntry::make('pagu_kegiatan')
                    ->numeric(),
                TextEntry::make('pagu_kegiatan_perubahan')
                    ->numeric(),
                TextEntry::make('kd_kegiatan_lokal'),
                IconEntry::make('is_deleted')
                    ->boolean(),
                TextEntry::make('_event_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
