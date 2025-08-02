<?php

namespace App\Filament\Resources\MisiTujuanSasarans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MisiTujuanSasaranForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_sasaran'),
                TextInput::make('misi_tujuan_id')
                    ->required()
                    ->numeric(),
                Textarea::make('name_sasaran')
                    ->columnSpanFull(),
                TextInput::make('tags'),
                Toggle::make('active')
                    ->required(),
                TextInput::make('tahun'),
            ]);
    }
}
