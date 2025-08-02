<?php

namespace App\Filament\Resources\Skpds\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SkpdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kd_satker')
                    ->numeric(),
                Textarea::make('kd_satker_str')
                    ->columnSpanFull(),
                Textarea::make('kd_satker_str_lokal')
                    ->columnSpanFull(),
                TextInput::make('name_satker'),
                TextInput::make('short_name_satker'),
                TextInput::make('asisten'),
                TextInput::make('nama_asisten'),
                Textarea::make('alamat')
                    ->columnSpanFull(),
                TextInput::make('telepon')
                    ->tel(),
                Textarea::make('fax')
                    ->columnSpanFull(),
                TextInput::make('kodepos')
                    ->numeric(),
                TextInput::make('status_satker'),
                Textarea::make('ket_satker')
                    ->columnSpanFull(),
                TextInput::make('jenis_satker'),
                TextInput::make('kd_klpd'),
                TextInput::make('nama_klpd'),
                TextInput::make('jenis_klpd'),
                TextInput::make('kode_eselon'),
                TextInput::make('nama_eselon'),
                TextInput::make('tahun'),
                TextInput::make('tags'),
            ]);
    }
}
