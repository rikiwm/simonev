<?php

namespace App\Filament\Resources\MisiTujuans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MisiTujuanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_tujuan'),
                TextInput::make('misi_id')
                    ->required()
                    ->numeric(),
                Textarea::make('name_tujuan')
                    ->columnSpanFull(),
                TextInput::make('tags'),
                Toggle::make('active')
                    ->required(),
                TextInput::make('tahun'),
            ]);
    }
}
