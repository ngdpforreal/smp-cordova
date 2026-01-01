<?php

namespace App\Filament\Resources\AcademicCalendarResource\Pages;

use App\Filament\Resources\AcademicCalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use \Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateAcademicCalendar extends CreateRecord
{
    use Translatable;
    protected static string $resource = AcademicCalendarResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
