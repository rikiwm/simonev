<?php

namespace App\Filament\Resources\Urusans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UrusanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_urusan'),
                TextInput::make('name_urusan'),
                TextInput::make('slug'),
                TextInput::make('tags'),
                Toggle::make('is_active'),
            ]);
    }
}
