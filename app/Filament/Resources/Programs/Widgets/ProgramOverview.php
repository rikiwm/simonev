<?php

namespace App\Filament\Resources\Programs\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProgramOverview extends StatsOverviewWidget
{

    protected ?string $pollingInterval = null;
protected static bool $isLazy = false;
protected ?string $heading = 'Analytics';

protected int | string | array $columnSpan = '1';
    protected function getStats(): array
    {
        return [
           Stat::make('Unique views', '192.1k')
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
              Stat::make('Unique views', '192.1k')
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
              Stat::make('Unique views', '192.1k')
            ->description('32k increase')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),


        ];
    }

 

    
}
