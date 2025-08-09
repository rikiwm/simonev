<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Resources\SubKegiatans\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubKegiatanInfolist
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
                TextEntry::make('kd_subkegiatan')
                    ->numeric(),
                TextEntry::make('kd_subkegiatan_str'),
                TextEntry::make('pagu_subkegiatan')
                    ->numeric(),
                TextEntry::make('pagu_subkegiatan_perubahan')
                    ->numeric(),
                TextEntry::make('kd_subkegiatan_lokal'),
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
