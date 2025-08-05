<?php

namespace App\Filament\Resources\Programs\Pages;

use App\Filament\Resources\Programs\ProgramResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use App\Models\Program;
use App\Models\ProgramSubKegiatanMaster;
use App\Models\Bidang;
use Filament\Notifications\Notification;

class ShowProgram extends Page
{
    protected static string $resource = ProgramResource::class;
    protected string $view = 'filament.resources.programs.pages.show-program';
     public ?array $data = [];
    public function mount(int|string $record): void
    {
           $datakegiatan = Program::where('kd_program', $record)->get();
        // $nomenklatur = ProgramSubKegiatanMaster::query()
        //                 ->with('indikatorsubkegiatan')
        //                 ->where('kd_satker', auth()->user()->kd_satker_lokal)
        //                 ->whereIn('kd_subkegiatan_str', $final)
        //                 ->orderBy('kd_subkegiatan_str', 'asc')
        //                 ->get();
        $this->record = [
            'program' => $datakegiatan->first()->nama_program ?? '-',
            'kd_program' => $datakegiatan->first()->kd_program ?? '-',
            'kd_program_str' => $datakegiatan->first()->kd_program_str ?? '-',
            'indikators' => collect(range(2025, date('Y')))->map(fn($year) => [
                'tahun' => (string) $year,
                'target_value' => null,
                'realisasi_value' => null,
                'document' => null,
                // 'triwulans' => \App\Models\Triwulan::visible()
                //     ->get()
                //     ->map(fn($tw) => [
                //         'id' => $tw->id,
                //         'name' => $tw->name,
                //         'realisasi_value' => null,
                //     ])->toArray(),
            ])->toArray(),
        ];

    }

    public function form(Schema $schema): Schema
    {
     return $schema
            ->components([
                Section::make('')->compact()->description('Progres')
                        ->schema([
                            Placeholder::make('1')->content(new HtmlString('<div class="h-5 border-collapse rounded-md shadow-md bg-gray-50 dark:bg-gray-800"></div>')),
                        ]),
                Section::make('')->compact()->aside()
                    ->description(
                        new HtmlString('
                            <div class="p-3 space-y-4 bg-white shadow rounded-xl dark:bg-gray-900">
                            <div class="px-4 py-3 rounded-md shadow dark:bg-gray-800">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-md opacity-60">' . ($this->record['skpd'] ?? '') . '</span>
                                </div>
                                <div class="h-3 my-2 rounded-md shadow bg-gray-50 dark:bg-gray-700"></div>
                                    <div class="flex flex-col py-1">
                                        <p class="text-sm font-normal">' . ($this->record['kd_program_str'] ?? '') . ' - ' . ($this->record['program'] ?? '') . '</p>
                                        <span class="text-sm">' . ($this->record['kd_program_str'] ?? '') . ($this->record['kd_kegiatan'] ?? '') . ' - ' . ($this->record['kegiatan'] ?? '') . '</span>
                                    </div>
                                </div>
                            </div>'))
                    ->schema([
                        Grid::make([
                                Textarea::make('indikator_outcome')->label(false)->hint('Indikator Outcome')->hintColor('primary'),
                                Placeholder::make('2')->content(new HtmlString('<div class="h-3 rounded shadow bg-gray-50 dark:bg-gray-700"></div>')),
                            ]),
                        Repeater::make('kegiatan')->label('Indikator Output Kegiatan')
                            ->schema([
                                // Placeholder::make('3')->label('Sub Kegiatan')->content(fn(Get $get) => '' . Str::headline($get('nama_subkegiatan')))->extraAttributes(['class' => 'dark:bg-gray-500 bg-gray-200 px-2 rounded-md ']),
                                // Placeholder::make('4')->content(fn(Get $get) => 'Pelaksana : ' . Str::headline($get('pelaksana')))->extraAttributes(['class' => 'dark:bg-gray-600 bg-gray-100 rounded-md px-2 -mb-2 -mt-4 text-xs opacity-90']),
                                // Placeholder::make('5')->content(fn(Get $get) => 'Kinerja : ' . Str::headline($get('kinerja')))->extraAttributes(['class' => 'dark:bg-gray-700 bg-gray-50 rounded-md px-2 -mt-4 text-xs']),
                                // Placeholder::make('6')->content(fn(Get $get) => 'Sub Kegiatan Sebelumnya : ' . Str::headline($get('subkeg_before')))->extraAttributes(['class' => 'dark:bg-gray-800 bg-gray-50 rounded-md px-2 -mt-4 text-xs']),
                                Textarea::make('indikator')->default('-')->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                                Flex::make([
                                    TextInput::make('satuan')->default('-')->label('Satuan')->grow(true)->columnSpanFull(),
                                    Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                        ->helperText('Default :Yes!')
                                        ->grow(false)
                                ])
                                ])
                                ->addable()
                                ->reorderable()
                                ->collapsible()
                                ->deletable()
                                // ->extraItemActions([
                                //     Action::make('save')
                                //         ->label(false)
                                //     ->action(function (array $arguments, Get $get) {
                                //             $index = $arguments['item'] ?? null;

                                //             if ($index !== null) {
                                //                 $nama = $get("data.{$index}.nama_subkegiatan");
                                //                 $volume = $get("data.{$index}.satuan");
                                //                 Notification::make('success')
                                //                     ->title('Item Disimpan')
                                //                 ->body("Kegiatan '{$nama}' dengan volume {$volume} berhasil disimpan.")
                                //                     ->success()
                                //                     ->send();
                                //             }
                                //         })
                                //         ->icon('heroicon-m-check-circle')->color('success')
                                //     ])
                                ->defaultItems(1)
                                // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] . ' - Pagu : Rp.' . number_format($state['pagu_subkegiatan'], 0, ',', '.') ?? null)
                                ->grid(2)
                                ->statePath('data'),
                    ])

            ]);

    }
}
