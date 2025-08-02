<?php

namespace App\Filament\Resources\Apbds\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ApbdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('UNITKEY'),
                TextInput::make('KDUNIT'),
                TextInput::make('SKPD'),
                TextInput::make('IDURUSAN'),
                TextInput::make('IDPRGRM'),
                TextInput::make('KDPRGRM'),
                TextInput::make('NMPRGRM'),
                TextInput::make('IDKEG'),
                TextInput::make('NUKEG'),
                Textarea::make('NMKEG')
                    ->columnSpanFull(),
                TextInput::make('IDSUBKEG'),
                TextInput::make('KDSUBKEG'),
                TextInput::make('ANGGARAN'),
                TextInput::make('REALISASI'),
                TextInput::make('tahun_anggaran'),
                DatePicker::make('event_date'),
            ]);
    }
}
