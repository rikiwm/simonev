<?php

namespace App\Filament\Resources\Bidangs\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BidangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('urusan_id')
                    ->numeric(),
                TextEntry::make('kd_urusan_str'),
                TextEntry::make('kode_bidang'),
                TextEntry::make('name_bidang'),
                TextEntry::make('short_name'),
                TextEntry::make('slug'),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
