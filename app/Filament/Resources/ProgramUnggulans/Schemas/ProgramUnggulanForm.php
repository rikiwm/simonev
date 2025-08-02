<?php

namespace App\Filament\Resources\ProgramUnggulans\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProgramUnggulanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('name')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('slug'),
                TextInput::make('tags'),
                Textarea::make('options')
                    ->columnSpanFull(),
                Toggle::make('visible')
                    ->required(),
                TextInput::make('mulai_tahun'),
                TextInput::make('end_tahun'),
                Toggle::make('expired'),
            ]);
    }
}
