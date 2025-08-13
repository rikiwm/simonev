<?php

namespace App\Filament\Resources\Programs\Resources\Kegiatans\Pages;

use App\Filament\Resources\Programs\Resources\Kegiatans\KegiatanResource;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Resources\Pages\ViewRecord;
// use Filament\Schemas\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;

class ViewKegiatan extends ViewRecord
{
    use InteractsWithForms;

    protected static string $resource = KegiatanResource::class;
    public $indikator = [];

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }


    public function mount(int|string $record): void
    {
         parent::mount($record);
    // $data = $this->record->indikatorprogram ?? IndikatorProgram::where('nama_program', $this->record->nama_program)->firstOrFail();
        $this->indikator = collect(range(1, 1))->map(function ($i)  {
        return [
            'indikator'     =>  null, // bisa diubah kalau target per triwulan beda
            'satuan'     => null, 
            // 'satuan'     => Str::limit( $data->indikator ?? null,12,'', preserveWords:true), 
            'triwulan'   => "Triwulan {$i}",
            'target'     => null, // bisa diubah kalau target per triwulan beda
            'realisasi'  => null,
            'keterangan' => null,
        ];
    })->toArray();
        // parent::mount($record);
// dd($this->triwulan);
    }


    // public function saveTriwulan(): void
    // {
    //     $this->record->update([
    //         'triwulan' => $this->triwulan,
    //     ]);

    //     \Filament\Notifications\Notification::make()
    //         ->title('Data Triwulan berhasil disimpan!')
    //         ->success()
    //         ->send();
    // }
    //    public function infolist(Schema $schema): Schema
    // {
    //     dd($this->triwulan);

    //     dd($schema);
    //     return $schema
    //     // KegiatanInfolist::configure($schema);
    //         ->components([
    //             Section::make('Form Input Outcome')
    //                 ->schema([
    //                     Repeater::make('outcomes')
    //                         ->label('Data Per Triwulan')
    //                         ->schema([
    //                             TextInput::make('triwulan')
    //                                 ->disabled()
    //                                 ->dehydrated()
    //                                 ->required(),
    //                             TextInput::make('target')
    //                                 ->numeric()
    //                                 ->required(),
    //                             TextInput::make('realisasi')
    //                                 ->numeric()
    //                                 ->required(),
    //                             Textarea::make('keterangan')
    //                                 ->rows(2)
    //                                 ->columnSpanFull(),
    //                         ])
    //                         ->columns(3)
    //                         ->minItems(4)
    //                         ->maxItems(4)
    //                         ->reorderable(false)
    //                         ->statePath('outcomes'),

                    
    //                 ]),
    //             ]);
    // }
}
