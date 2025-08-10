<?php

namespace App\Filament\Resources\Programs\RelationManagers;

use App\Filament\Resources\Programs\ProgramResource;
use App\Filament\Resources\Programs\Resources\Kegiatans\KegiatanResource;
use App\Models\Kegiatan;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\Size;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\InfoList\InfoList;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;


class KegiatanRelationManager extends RelationManager
{
    protected static string $relationship = 'kegiatans';
    protected static bool $isLazy = false;
    protected static ?string $relatedResource = KegiatanResource::class;

    public function table(Table $table): Table
    {
        return $table
        // ->query(Kegiatan::query()->orderBy('kd_kegiatan_str','asc'))
        ->deferLoading()
        ->defaultSort('kd_kegiatan_str','asc')
            ->columns([
                TextColumn::make('tahun_anggaran')->label('Thn')
                ->size(TextSize::ExtraSmall)->weight(FontWeight::Light)->badge()
                 ->sortable()->toggleable(isToggledHiddenByDefault: true)
                ->wrap(),
                TextColumn::make('nama_kegiatan')
                ->prefix(fn($record) => $record->kd_kegiatan_str.' - ')->wrap()->size(TextSize::Small)->weight(FontWeight::Medium)
                    ->searchable()->color(fn ($record) => Str::startsWith($record->kd_kegiatan_str, 'P') ? 'primary' : 'secondary')
                ->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('kd_kegiatan_str')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_kegiatan')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_kegiatan_str')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('pagu_kegiatan')->label('Pagu')
                  ->money('IDR', true)->prefix('Rp ')
                    ->suffix(',-')
                    ->formatStateUsing(fn ($state) => number_format($state, 0, ',', '.'))
                    ->weight(FontWeight::Medium)
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('pagu_kegiatan_perubahan')
                    ->numeric()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('kd_kegiatan_lokal')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_deleted')
                    ->boolean()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('_event_date')
                    ->date()
                    ->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
               ->heading(false)
        ->description(false)
              ->recordActions([
                EditAction::make()->label(false),
                ViewAction::make()->modal(false)->icon('heroicon-s-arrow-long-right')->color('danger')->label(false),
            ])
            ->headerActions([
                CreateAction::make()->size(Size::ExtraSmall)->outlined()->label('Tambah'),
            ]);
    }

    public function form(Schema $schema): Schema
{
    return $schema
        ->components([
             TextInput::make('tahun_anggaran'),
                TextInput::make('kd_klpd'),
                TextInput::make('kd_satker')
                    ->numeric(),
                TextInput::make('kd_program')
                    ->numeric(),
                TextInput::make('kd_kegiatan')
                    ->numeric(),
                TextInput::make('kd_kegiatan_str'),
                Textarea::make('nama_kegiatan')
                    ->columnSpanFull(),
                TextInput::make('pagu_kegiatan')
                    ->numeric(),
                TextInput::make('pagu_kegiatan_perubahan')
                    ->numeric(),
        ]);
}


}
