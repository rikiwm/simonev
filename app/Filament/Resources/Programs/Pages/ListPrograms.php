<?php

namespace App\Filament\Resources\Programs\Pages;

use App\Filament\Resources\Programs\ProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Size;
class ListPrograms extends ListRecords
{
    protected static string $resource = ProgramResource::class;
protected ?string $heading = '  Heading';
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->size(Size::ExtraSmall)->hidden(fn() => !auth()->user()->hasRole('super_admin'))
               ];
    }
    
 
}
