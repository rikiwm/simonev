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
     use InteractsWithRecord;
    protected static string $resource = ProgramResource::class;
    protected string $view = 'filament.resources.programs.pages.show-program';
     public ?array $data = [];
     protected ?string $heading = ' Page ';
// protected int | string | array $columnSpan = '4';
  public function getHeaderWidgetsColumns(): int | array
{
    return 2;
}
    public function mount(int|string $record): void
    {
           $datakegiatan = Program::with('bidang')->where('kd_program', $record)->get();
        // $nomenklatur = ProgramSubKegiatanMaster::query()
        //                 ->with('indikatorsubkegiatan')
        //                 ->where('kd_satker', auth()->user()->kd_satker_lokal)
        //                 ->whereIn('kd_subkegiatan_str', $final)
        //                 ->orderBy('kd_subkegiatan_str', 'asc')
        //                 ->get();
        // dd($datakegiatan->first()->bidang->name_bidang);
        $this->record = [
            'program' => $datakegiatan->first()->nama_program ?? '-',
            'bidang' => $datakegiatan->first()->bidang->name_bidang ?? '-',
            'kd_bidang_str' => $datakegiatan->first()->kd_bidang_str ?? '-',
            'kd_program' => $datakegiatan->first()->kd_program ?? '-',
            'kd_program_str' => $datakegiatan->first()->kd_program_str ?? '-',
            'indikators' => collect(range(2022, date('Y')))->map(fn($year) => [
                'tahun' => (int) $year,
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
        $this->record = $record;

    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\Programs\Widgets\ProgramOverview::class,
            \App\Filament\Resources\Programs\Widgets\ProgramState::class
            ];
    }

    public function form(Schema $schema): Schema
    {
     return $schema
            ->components([
                Section::make('')->compact()->secondary()->id('kd_bidang_str')
                ->description('')
                    // ->description(
                    //     new HtmlString('
                    //         <div class="bg-white shadow rounded-xl dark:bg-gray-900">
                    //         <div class="px-4 py-3 rounded-md shadow dark:bg-gray-800 ">
                    //         <br>
                    //             <div class="flex">
                    //                <span class="fi-size-xs fi-font-medium fi-ta-text-item">' . ($this->record['kd_bidang_str'] ?? '').' - '.($this->record['bidang'] ?? '').'</span>
                    //             </div>
                    //             <div class="h-4 my-2 rounded-md shadow bg-gray-200 dark:bg-gray-700"></div>
                    //                 <div class="flex">
                    //                         <p class="fi-size-sm fi-font-medium fi-ta-text-item">' . ($this->record['kd_program_str'] ?? '') . ' - ' . ($this->record['program'] ?? '') . '</p>
                    //                 </div>
                    //             </div>
                    //         </div>'))
                    ->schema([
                    
                        Repeater::make('indikator')->label('Indikator Output Kegiatan')
                            ->schema([
                                // Placeholder::make('3')->label('Sub Kegiatan')->content(fn(Get $get) => '' . Str::headline($get('nama_subkegiatan')))->extraAttributes(['class' => 'dark:bg-gray-500 bg-gray-200 px-2 rounded-md ']),
                                // Placeholder::make('4')->content(fn(Get $get) => 'Pelaksana : ' . Str::headline($get('pelaksana')))->extraAttributes(['class' => 'dark:bg-gray-600 bg-gray-100 rounded-md px-2 -mb-2 -mt-4 text-xs opacity-90']),
                                // Placeholder::make('5')->content(fn(Get $get) => 'Kinerja : ' . Str::headline($get('kinerja')))->extraAttributes(['class' => 'dark:bg-gray-700 bg-gray-50 rounded-md px-2 -mt-4 text-xs']),
                                // Placeholder::make('6')->content(fn(Get $get) => 'Sub Kegiatan Sebelumnya : ' . Str::headline($get('subkeg_before')))->extraAttributes(['class' => 'dark:bg-gray-800 bg-gray-50 rounded-md px-2 -mt-4 text-xs']),
                                Textarea::make('indikator')->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
                                Flex::make([
                                    TextInput::make('tahun')->label('Satuan')->grow(true)->columnSpanFull(),
                                    Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
                                        ->helperText('Default :Yes!')
                                        ->grow(false)
                                ])
                                ])
                                ->addable()
                                ->reorderable(false)
                                ->collapsible()
                                // ->deletable()
                                    ->extraItemActions([
                                    Action::make('save')->icon('heroicon-m-document-arrow-up')
                                        ->label(false)
                                    ])
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
                                ->defaultItems(2)
                                // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] . ' - Pagu : Rp.' . number_format($state['pagu_subkegiatan'], 0, ',', '.') ?? null)
                                ->grid(4)
                    ])->statePath('data')

            ]);

    }
}
