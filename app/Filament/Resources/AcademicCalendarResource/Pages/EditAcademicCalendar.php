<?php

namespace App\Filament\Resources\AcademicCalendarResource\Pages;

use App\Filament\Resources\AcademicCalendarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use \Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditAcademicCalendar extends EditRecord
{
    use Translatable;
    protected static string $resource = AcademicCalendarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
