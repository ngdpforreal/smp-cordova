<?php

namespace App\Filament\Resources\AchievementResource\Pages;

use App\Filament\Resources\AchievementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use \Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateAchievement extends CreateRecord
{
    use Translatable;
    protected static string $resource = AchievementResource::class;
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
