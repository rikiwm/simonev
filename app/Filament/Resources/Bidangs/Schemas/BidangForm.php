<?php

namespace App\Filament\Resources\Bidangs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BidangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('urusan_id')
                    ->numeric(),
                TextInput::make('kd_urusan_str'),
                TextInput::make('kode_bidang'),
                TextInput::make('name_bidang'),
                TextInput::make('short_name'),
                TextInput::make('slug'),
                Textarea::make('description_bidang')
                    ->columnSpanFull(),
                TextInput::make('tags'),
                Toggle::make('is_active'),
            ]);
    }
}
