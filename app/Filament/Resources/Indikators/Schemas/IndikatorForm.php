<?php

namespace App\Filament\Resources\Indikators\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IndikatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('parent_id')
                    ->numeric(),
                Textarea::make('kode_indikators')
                    ->columnSpanFull(),
                Textarea::make('parent_indikator')
                    ->columnSpanFull(),
                Textarea::make('nama_indikator')
                    ->columnSpanFull(),
                TextInput::make('satuan'),
                Textarea::make('keterangan')
                    ->columnSpanFull(),
                TextInput::make('tags_satker'),
                TextInput::make('tags_sasaran'),
                TextInput::make('sumber_data')
                    ->default('RPJMD'),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_canges')
                    ->required(),
            ]);
    }
}
