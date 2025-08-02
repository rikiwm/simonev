<?php

namespace App\Filament\Resources\ActivasiProgramUnggulans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ActivasiProgramUnggulanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('program_unggulan_id')
                    ->required()
                    ->numeric(),
                Textarea::make('name')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('slug'),
                Textarea::make('options')
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->required(),
                Toggle::make('active')
                    ->required(),
                TextInput::make('tahun'),
                TextInput::make('tags_skpd'),
                TextInput::make('tags_misi'),
            ]);
    }
}
