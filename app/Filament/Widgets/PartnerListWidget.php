<?php

namespace App\Filament\Widgets;

use App\Models\Partner;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class PartnerListWidget extends BaseWidget
{
    protected static ?int $sort = 3; // Agar muncul di bawah widget berita
    
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Daftar Kemitraan Aktif';

    public function table(Table $table): Table
    {
        return $table
            ->query(Partner::query()->orderBy('order', 'asc'))
            ->columns([
                ImageColumn::make('logo')
                    ->label('')
                    ->square()
                    ->size(40),

                TextColumn::make('name')
                    ->label('Nama Mitra')
                    ->weight('bold'),

                TextColumn::make('website')
                    ->label('Tautan')
                    ->color('gray')
                    ->limit(30),

                ToggleColumn::make('is_active')
                    ->label('Status Display'),
            ])
            ->paginated(false);
    }
}