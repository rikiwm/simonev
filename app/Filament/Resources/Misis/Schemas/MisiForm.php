<?php

namespace App\Filament\Resources\Misis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_misi'),
                Textarea::make('name_misi')
                    ->columnSpanFull(),
                Toggle::make('active')
                    ->required(),
                TextInput::make('tahun'),
            ]);
    }
}
