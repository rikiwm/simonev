<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProgramInfolist
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
                TextEntry::make('kd_program_str'),
                TextEntry::make('pagu_program')
                    ->numeric(),
                TextEntry::make('pagu_program_perubahan')
                    ->numeric(),
                TextEntry::make('kd_program_lokal'),
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
