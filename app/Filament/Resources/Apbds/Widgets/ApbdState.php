<?php

namespace App\Filament\Resources\Apbds\Widgets;

use App\Filament\Resources\Apbds\Pages\ListApbds;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ApbdState extends StatsOverviewWidget
{
    protected ?string $pollingInterval = null;
    // protected static bool $isLazy = true;
    protected static bool $isLazy = false;

    protected ?string $heading = 'Analytics';
  use InteractsWithPageTable;
protected int | string | array $columnSpan = '2';

 protected function getTablePage(): string
    {
        return ListApbds::class;
    }

    public static function canView(): bool
{
    return auth()->user()->hasRole('opd');
}
    protected function getStats(): array
    {


    switch (true) {
        case auth()->user()->hasRole('super_admin'):
            $pagu = $this->getPageTableQuery()->get()->sum('Pagu') ?? 0;
            $pagu_r = $this->getPageTableQuery()->get()->sum('Realisasi') ?? 0;
           
            // $th = $this->getPageTableRecords()->items()[0]['tahun_anggaran'] ?? 0;
            break;

        case auth()->user()->hasRole('admin'):
            $pagu = $this->getPageTableRecords()->items()[0]['Pagu'] ?? 0;
            $pagu_r = $this->getPageTableRecords()->items()[0]['Realisasi'] ?? 0;
            // $pd = $this->getPageTableRecords()->items()[0]['name_satker'] ?? 0;
            // $kd = $this->getPageTableRecords()->items()[0]['kd_satker_str'] ?? 0;
            // $th = $this->getPageTableRecords()->items()[0]['tahun_anggaran'] ?? 0;
            break;

        case auth()->user()->hasRole('verifikator'):
                     $pagu = $this->getPageTableRecords()->items()[0]['Pagu'] ?? 0;
            $pagu_r = $this->getPageTableRecords()->items()[0]['Realisasi'] ?? 0;
         
            // $th = $this->getPageTableRecords()->items()[0]['tahun_anggaran'] ?? 0;
            break;

        case auth()->user()->hasRole('opd'):
            $pagu = $this->getPageTableRecords()->items()[0]['Pagu'] ?? 0;
            $pagu_r = $this->getPageTableRecords()->items()[0]['Realisasi'] ?? 0;
            // $pd = $this->getPageTableRecords()->items()[0]['name_satker'] ?? 0;
            // $kd = $this->getPageTableRecords()->items()[0]['kd_satker_str'] ?? 0;
            // $th = $this->getPageTableRecords()->items()[0]['tahun_anggaran'] ?? 0;
            break;

        default:
            // Aksi jika tidak memiliki salah satu role di atas
            echo "Role tidak dikenali. Akses dibatasi.";
            break;
    }

        // $pagu = $this->getPageTableRecords()->items()[0]['Pagu'] ?? 0;
        // $pagu_r = $this->getPageTableRecords()->items()[0]['Realisasi'] ?? 0;
        // // $pd = $this->getPageTableRecords()->items()[0]['name_satker'] ?? 0;
        // // $kd = $this->getPageTableRecords()->items()[0]['kd_satker_str'] ?? 0;
        // // $th = $this->getPageTableRecords()->items()[0]['tahun_anggaran'] ?? 0;

        return [
            Stat::make('Pagu Anggaran', $pagu)
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Realisasi Anggaran', $pagu_r)
                ->description('7% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Pendapatan Daerah', '9999x')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                 Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                 Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                 Stat::make('Average time on page', '3:12')
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
