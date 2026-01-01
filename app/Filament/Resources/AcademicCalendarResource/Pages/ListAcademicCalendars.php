<?php

namespace App\Filament\Resources\AcademicCalendarResource\Pages;

use App\Filament\Resources\AcademicCalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use \Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListAcademicCalendars extends ListRecords
{
    use Translatable;
    protected static string $resource = AcademicCalendarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
