<?php

namespace App\Filament\Resources\ExtracurricularResource\Pages;

use App\Filament\Resources\ExtracurricularResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateExtracurricular extends CreateRecord
{
    use Translatable;
    protected static string $resource = ExtracurricularResource::class;
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
