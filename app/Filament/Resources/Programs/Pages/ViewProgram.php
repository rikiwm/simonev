<?php

namespace App\Filament\Resources\Programs\Pages;

use App\Filament\Resources\Programs\ProgramResource;
use App\Models\IndikatorProgram;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Carbon\Carbon;
use Filament\Actions\Action as ActionsAction;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\View;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
class ViewProgram extends ViewRecord
{
    // use InteractsWithForms;
    protected static string $resource = ProgramResource::class;
    protected ?string $heading = 'Program';
    public $indikatorprogram = [];
    protected $listeners = ['refresh' => '$refresh'];

    public function getSubheading(): ?string
    {
        return __($this->record->nama_program);
    }
    
    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
            ActionsAction::make('addIndikator')
                ->label('Tambah Indikator')
                ->color('secondary')
                ->size(Size::ExtraSmall)
                ->icon('heroicon-o-plus-circle')
                   ->form([TextInput::make('satuan')
                                    ->label('Satuan')
                                    ->required()
                                    ->columnSpan(2),
                                ToggleButtons::make('is_sum')
                                    ->label('Akumulasi?')
                                    ->boolean()
                                    ->grouped()
                                    ->inline()
                                    ->columnSpan(2),
                                Textarea::make('indikator')
                                    ->label('Indikator')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                ->action(function ($livewire) {
                      $fill = $livewire->mountedActions[0]['data'] ?? [];
                  dd($fill);
                //    $record->update([
                //                     'satuan'   => $data['satuan'],
                //                     'is_sum'   => $data['is_sum'],
                //                     'indikator'=> $data['indikator'],
                //                 ]);
                    Notification::make()
                        ->title('Indikator Program berhasil ditambah')
                        ->body('Indikator Program berhasil ditambah')
                        ->success()
                        ->send();
                }),
        ];
    }
    //    protected function getFormSchema(): array
    // {
    // {
    //     return [
    //         ProgramInfolist::configure($schema);
    //     ];
    // }
public function mount(int|string $record): void
{
    parent::mount($record);

    $data = $this->record->indikatorprogram ?? null;
    // if($data->isEmpty()){
    //      $new =  IndikatorProgram::where('nama_program', $this->record->nama_program)->first();
    //     $data = $new;
    // }
    
    $datas = collect($data)->map(function ($item,$key) use ($data) {
        return [
            'id'     =>  $item->id ?? null,
            'kode_indikator'     =>  null,
            'kd_program'     => $item->kd_program ?? null,
            'kd_program_str'     => $item->kd_program_str?? null,
            'indikator'     => $item->indikator?? null, 
            'satuan'     =>  $item->satuan ?? Str::limit($item->indikator ?? null,12,'', preserveWords:true), 
            'type'   => "Indikator Program - {$key}",
            'key'   => "Indikator ke-{$key}",
            'target'     => null,
            'realisasi'  => null,
            'keterangan' => null,
        ];
    })->toArray();

   $this->record->fill([
    'pagu_program_perubahan' => '200000',
]);

    $this->indikatorprogram = $datas;
    //  "kd_bidang" => "1.05"
    //   "kd_program" => "2529222"
    //   "kd_program_str" => "1.05.01"
    //   "nama_program" => "PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA"
    //   "satuan" => null
    //   "indikator" => "Persentase terlaksananya penunjang urusan pemerintah"
    //   "definisi" => null
    //   "indikator_outcome_canges" => null
    //   "indikator_outcome_before" => null
    //   "kd_satker" => "75549"
    //   "satker" => "DINAS PENDIDIKAN DAN KEBUDAYAAN"
    //   "tags" => null
    //   "sumber_data" => null
    //   "is_active" => 1
    //   "is_canges" => 0
}


    protected function beforeFill(): void
    {
        //  Log::info('Melihat data program:', $this->record);
    }

    protected function afterFill(): void
    {
            Notification::make()
                ->title('Program ini sudah selesai.')
                ->warning()
                ->send();
    }

    //   public function mount(string $record, string $skpd)
    // {
        // $datakegiatan = sikd::where('IDKEG', $record)
        //     ->where('UNITKEY', $skpd)
        //     ->where('tahun', Carbon::now()->format('Y-m-d'))
        //     ->orderBy('KDSUBKEG', 'asc')
        //     ->get();
        // $d = $datakegiatan->map(function ($item) {
        //     return collect(explode('.', $item->KDUNIT))
        //         ->take(6)
        //         ->implode('.');
        // })->toArray();
        // $data = collect($d[0]);
        // $chunks = str_split($data->implode(''), 5);
        // $map = collect($chunks)->map(function ($item) {
        //     return [
        //         'd' => Str::limit($item, 4, '')
        //     ];
        // })->toArray();
        // $bidang = Bidang::whereIn('kode', $map)->get()->toArray();
        // $nomenklatur = collect();
        // foreach ($bidang as $b) {
        //     $final = $datakegiatan->map(function ($item) use ($b) {
        //         return $b['kode'] . '.' . $item->KDPRGRM . rtrim($item->KDSUBKEG, '.');
        //     })->toArray();
        //     $nomenklatur = ProgramSubKegiatanMaster::query()
        //         ->with('indikatorsubkegiatan')
        //         ->where('kd_satker', auth()->user()->kd_satker_lokal)
        //         ->whereIn('kd_subkegiatan_str', $final)
        //         ->orderBy('kd_subkegiatan_str', 'asc')
        //         ->get();
        //     if ($nomenklatur->isNotEmpty()) {
        //         break;
        //     }
        // }

        // $this->record = [
        //     'program' => $datakegiatan->first()->NMPRGRM ?? '-',
        //     'kd_program' => $datakegiatan->first()->KDPRGRM ?? '-',
        //     'skpd' => $datakegiatan->first()->SKPD ?? '-',
        //     'kdunit' => $datakegiatan->first()->KDUNIT ?? '-',
        //     'kegiatan' => $datakegiatan->first()->NMKEG ?? '-',
        //     'kd_kegiatan' => $datakegiatan->first()->NUKEG ?? '-',
        //     'anggaran' => $datakegiatan->first()->ANGGARAN ?? 0,
        //     'f' => $final,
        //     'indikators' => $datakegiatan->map(fn($data) => [
        //         'tahun' => 2025,
        //         'target_value' => null,
        //         'realisasi_value' => null,
        //         'document' => null,
        //         'triwulans' => \App\Models\Triwulan::visible()
        //             ->get()
        //             ->map(fn($tw) => [
        //                 'id' => $tw->id,
        //                 'name' => $tw->name,
        //                 'realisasi_value' => null,
        //             ])->toArray(),
        //     ])->toArray(),
        // ];
        // $this->form->fill([
        //     'data' => $nomenklatur->map(fn($data) => [
        //         'kinerja' => $data->indikatorsubkegiatan?->kinerja,
        //         'indikator' => $data->indikatorsubkegiatan?->indikator,
        //         'satuan' => $data->indikatorsubkegiatan?->satuan,
        //         'pelaksana' => $data->indikatorsubkegiatan?->pelaksana,
        //         'spm' => $data->indikatorsubkegiatan?->spm,
        //         'jenis' => $data->indikatorsubkegiatan?->jenis,
        //         'subkeg_before' => $data->indikatorsubkegiatan?->subkeg_before,
        //         'kd_subkegiatan' => $data->kd_subkegiatan_str,
        //         'pagu_subkegiatan' => $data->pagu_subkegiatan,
        //         'kd_satker' => $data->kd_satker,
        //         'nama_subkegiatan' => $data->nama_subkegiatan,
        //         'tahun' => 2025,
        //         'target_value' => null,
        //         'realisasi_value' => null,
        //         'document' => null,
        //         // 'triwulans' => \App\Models\Triwulan::visible()
        //         //     ->get()
        //         //     ->map(fn($tw) => [
        //         //         'id' => $tw->id,
        //         //         'name' => $tw->name,
        //         //         'realisasi_value' => null,
        //         //     ])
        //         //     ->toArray(),
        //     ])->toArray(),
        // ]);
    // }

    // public static function getRelativeRouteName(): string
    // {
    //     return SikdDetailTagging::getUrl(panel: 'simetris');
    // }

    // public  function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Section::make('')->compact()->description('Progres')
    //                     ->schema([
    //                         Placeholder::make('')->content(new HtmlString('<div class="h-5 border-collapse rounded-md shadow-md bg-gray-50 dark:bg-gray-800"></div>')),
    //                     ]),
    //             Section::make('')->compact()->aside()
    //                 ->description(
    //                     new HtmlString('
    //                         <div class="p-3 space-y-4 bg-white shadow rounded-xl dark:bg-gray-900">
    //                         <div class="px-4 py-3 rounded-md shadow dark:bg-gray-800">
    //                             <div class="flex flex-col">
    //                                 <span class="font-semibold text-md opacity-60">' . $this->record['skpd'] . '</span>
    //                             </div>
    //                             <div class="h-3 my-2 rounded-md shadow bg-gray-50 dark:bg-gray-700"></div>
    //                                 <div class="flex flex-col py-1">
    //                                     <p class="text-sm font-normal">' . $this->record['kd_program'] . ' - ' . $this->record['program'] . '</p>
    //                                     <span class="text-sm">' . $this->record['kd_program'] . $this->record['kd_kegiatan'] . ' - ' . $this->record['kegiatan'] . '</span>
    //                                 </div>
    //                             </div>
    //                         </div>'))
    //                 ->schema([
    //                     Grid::make('')->columns(1)
    //                         ->schema([
    //                             Textarea::make('indikator_outcome')->label(false)->hint('Indikator Outcome')->hintColor('primary'),
    //                             Placeholder::make('')->content(new HtmlString('<div class="h-3 rounded shadow bg-gray-50 dark:bg-gray-700"></div>')),
    //                         ]),
    //                     Repeater::make('kegiatan')->label('Indikator Output Kegiatan')
    //                         ->schema([
    //                             // Placeholder::make('')->label('Sub Kegiatan')->content(fn(Get $get) => '' . Str::headline($get('nama_subkegiatan')))->extraAttributes(['class' => 'dark:bg-gray-500 bg-gray-200 px-2 rounded-md ']),
    //                             // Placeholder::make('')->content(fn(Get $get) => 'Pelaksana : ' . Str::headline($get('pelaksana')))->extraAttributes(['class' => 'dark:bg-gray-600 bg-gray-100 rounded-md px-2 -mb-2 -mt-4 text-xs opacity-90']),
    //                             // Placeholder::make('')->content(fn(Get $get) => 'Kinerja : ' . Str::headline($get('kinerja')))->extraAttributes(['class' => 'dark:bg-gray-700 bg-gray-50 rounded-md px-2 -mt-4 text-xs']),
    //                             // Placeholder::make('')->content(fn(Get $get) => 'Sub Kegiatan Sebelumnya : ' . Str::headline($get('subkeg_before')))->extraAttributes(['class' => 'dark:bg-gray-800 bg-gray-50 rounded-md px-2 -mt-4 text-xs']),
    //                             // Textarea::make('indikator')->default('-')->label('Indikator Kinerja')->helperText('Berdasarkan Nomenklatur (Meta Data 2026)'),
    //                             // Split::make([
    //                             //     TextInput::make('satuan')->default('-')->label('Satuan')->grow(true)->columnSpanFull(),
    //                             //     Radio::make('is_akumulasi')->boolean()->inline()->inlineLabel(false)->label('Akumulasi ?')
    //                             //         ->helperText('Default :Yes!')
    //                             //         ->grow(false)
    //                             // ])
    //                             // ])
    //                             // ->collapseAllAction(fn(Action $action) => $action->label('Tutup')->icon('heroicon-m-arrow-down-circle'))
    //                             // ->expandAllAction(fn(Action $action) => $action->label('Lihat')->icon('heroicon-m-arrow-up-circle')->color('primary'))
    //                             // ->addable(false)
    //                             // ->reorderable(false)
    //                             // ->collapsible()
    //                             // ->deletable()
    //                             // ->extraItemActions([
    //                             //     Action::make('save')
    //                             //         ->label(false)
    //                             //     ->action(function (array $arguments, Get $get) {
    //                             //             $index = $arguments['item'] ?? null;

    //                             //             if ($index !== null) {
    //                             //                 $nama = $get("data.{$index}.nama_subkegiatan");
    //                             //                 $volume = $get("data.{$index}.satuan");
    //                             //                 Notification::make('success')
    //                             //                     ->title('Item Disimpan')
    //                             //                 ->body("Kegiatan '{$nama}' dengan volume {$volume} berhasil disimpan.")
    //                             //                     ->success()
    //                             //                     ->send();
    //                             //             }
    //                             //         })
    //                             //         ->icon('heroicon-m-check-circle')->color('success')
    //                             //     ])
    //                             // ->defaultItems(1)
    //                             // ->itemLabel(fn(array $state): ?string => $state['kd_subkegiatan'] . ' - Pagu : Rp.' . number_format($state['pagu_subkegiatan'], 0, ',', '.') ?? null)
    //                             // ->grid(2)
    //                             // ->statePath('data'),
    //                 ]),
    //         ]);
    // }
}
