<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class LatestPosts extends BaseWidget
{
    // Mengatur lebar widget agar mengambil porsi layar penuh
    protected int | string | array $columnSpan = 'full';

    // Judul Widget
    protected static ?string $heading = 'Berita & Artikel Terbaru';

    // Urutan Tampil (Agar ada di bawah Stats)
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil 5 berita terakhir saja
                Post::query()->latest('published_at')->limit(5)
            )
            ->columns([
                ImageColumn::make('image')
                    ->label('')
                    ->circular()
                    ->size(40),

                TextColumn::make('title')
                    ->label('Judul')
                    ->weight('bold')
                    ->limit(50),

                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'berita' => 'info',
                        'artikel' => 'success',
                        'agenda' => 'warning',
                        'pengumuman' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                    ]),

                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->color('gray'),
            ])
            ->actions([
                // Tombol Edit langsung dari Dashboard
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Post $record): string => route('filament.admin.resources.posts.edit', $record)),
            ])
            ->paginated(false); // Matikan pagination agar simpel
    }
}