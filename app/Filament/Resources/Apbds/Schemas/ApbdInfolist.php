<?php

namespace App\Filament\Resources\Apbds\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ApbdInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('UNITKEY'),
                TextEntry::make('KDUNIT'),
                TextEntry::make('SKPD'),
                TextEntry::make('IDURUSAN'),
                TextEntry::make('IDPRGRM'),
                TextEntry::make('KDPRGRM'),
                TextEntry::make('NMPRGRM'),
                TextEntry::make('IDKEG'),
                TextEntry::make('NUKEG'),
                TextEntry::make('IDSUBKEG'),
                TextEntry::make('KDSUBKEG'),
                TextEntry::make('ANGGARAN'),
                TextEntry::make('REALISASI'),
                TextEntry::make('tahun_anggaran'),
                TextEntry::make('event_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
