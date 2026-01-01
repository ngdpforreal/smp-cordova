<?php

namespace App\Filament\Widgets;

use App\Models\Testimonial;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class LatestTestimonials extends BaseWidget
{
    // Kita atur agar muncul setelah Berita
    protected static ?int $sort = 4;
    
    // Mengambil lebar penuh agar teks ulasan terbaca
    protected int | string | array $columnSpan = 1;

    protected static ?string $heading = 'Ulasan & Testimoni Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil 5 testimoni terakhir
                Testimonial::query()->latest()->limit(5)
            )
            ->columns([
                ImageColumn::make('photo')
                    ->label('')
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->label('Nama')
                    ->weight('bold')
                    ->description(fn (Testimonial $record): string => $record->role ?? '-'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn (string $state): string => $state . ' ★'),

                TextColumn::make('content')
                    ->label('Ulasan')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->color('gray'),

                // Fitur Toggle agar bisa langsung publish/unpublish dari dashboard
                // Pastikan di database ada kolom 'is_active' atau 'is_published'
                // Jika tidak ada, ganti dengan TextColumn status biasa
                // ToggleColumn::make('is_active')->label('Tampil'), 
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Testimonial $record): string => route('filament.admin.resources.testimonials.edit', $record))
                    ->button()
                    ->outlined()
                    ->size('xs'),
            ])
            ->paginated(false);
    }
}