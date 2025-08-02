<?php

namespace App\Filament\Resources\Apbds\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Apbd;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApbdsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        //   ->query(
    //              Apbd::query()
    //         ->select(
    //             DB::raw('MIN(id) as id'),
    //             DB::raw('UNITKEY as kd_satker'),
    //             'SKPD',
    //             'tahun',
    //             DB::raw('SUM(ANGGARAN) as ANGGARAN'),
    //             DB::raw('SUM(REALISASI) as REALISASI')
    //         )
    //         ->groupBy('SKPD','UNITKEY', 'tahun')
    //         ->where('tahun', Carbon::now()->format('Y-m-d'))
    //         ->orderBy('SKPD', 'asc')
    //          ->when(!auth()->user()->hasRole('Developer') && !auth()->user()->hasRole('super_admin'),
    //             function ($query) {
    //                 $namaSatker = auth()->user()->satker->nama_satker;
    //                 $satkerBerdasarkanNmKeg = [
    //                         'BAGIAN UMUM',
    //                         'BAGIAN TATA PEMERINTAHAN',
    //                         'BAGIAN PROTOKOL DAN KOMUNIKASI PIMPINAN',
    //                         'BAGIAN PEREKONOMIAN DAN SUMBER DAYA ALAM',
    //                         'BAGIAN PENGADAAN BARANG DAN JASA',
    //                         'BAGIAN ORGANISASI',
    //                         'BAGIAN KESEJAHTERAAN RAKYAT',
    //                         'BAGIAN KERJASAMA',
    //                         'BAGIAN HUKUM',
    //                         'BAGIAN ADMINISTRASI PEMBANGUNAN DAN PERENCANAAN',
    //                     ];

    //                     if (in_array(Str::upper($namaSatker), $satkerBerdasarkanNmKeg)) {
    //                         $bagian = trim(Str::replaceFirst('BAGIAN ', '', Str::upper($namaSatker)));
    //                         $filterNmKeg = Str::title(Str::lower($bagian));
    //                         $exceptionMap = [
    //                             'Kerjasama' => 'Kerja Sama',
    //                             'Administrasi Pembangunan Dan Perencanaan' => 'Administrasi Pembangunan',
    //                         ];
    //                         if (array_key_exists($filterNmKeg, $exceptionMap)) {
    //                             $filterNmKeg = $exceptionMap[$filterNmKeg];
    //                         }
    //                         $query->where('NMKEG', 'LIKE', '%' . $filterNmKeg . '%')->where('SKPD','SEKRETARIAT DAERAH');
    //                     } else {
    //                         // filter biasa SKPD
    //                         $query->where('SKPD', 'LIKE', $namaSatker);
    //                     }
    //                 }
    //             )
    //         // ->when(!auth()->user()->hasRole('Developer') && !auth()->user()->hasRole('super_admin'), function ($query) {
    //         //     $nama = auth()->user()->satker->nama_satker;
    //         //     $query->where('SKPD', 'LIKE', $nama);
    //         //     if ($nama == 'BAGIAN ') {
    //         //         dd('asd');
    //         //         # code...
    //         //     }
    //         // })
            ->columns([
                TextColumn::make('Unit Kerja')
                    ->searchable(),
                TextColumn::make('Pagu')
                    ->searchable(),
                TextColumn::make('Pagu Perubahan')
                    ->searchable(),
                TextColumn::make('Realisasi')
                    ->searchable(),
                TextColumn::make('tahun_anggaran')->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('event_date')
                    ->date()
                    ->sortable()->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
