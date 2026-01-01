<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;

class AchievementResource extends Resource
{
    use Translatable;
    protected static ?string $model = Achievement::class;

    // Icon Medali/Bintang untuk Prestasi
    protected static ?string $navigationIcon = 'heroicon-o-star';
    
    protected static ?string $navigationLabel = 'Prestasi Sekolah';
    
    protected static ?string $modelLabel = 'Prestasi';

    protected static ?string $pluralModelLabel = 'Prestasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (INFO UTAMA) ===
                Group::make()
                    ->schema([
                        Section::make('Detail Kejuaraan')
                            ->description('Informasi mengenai lomba dan pemenang.')
                            ->icon('heroicon-o-trophy')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Nama Kompetisi / Lomba')
                                    ->required()
                                    ->placeholder('Contoh: Olimpiade Sains Nasional (OSN) Matematika')
                                    ->prefixIcon('heroicon-m-academic-cap')
                                    ->maxLength(255),

                                TextInput::make('recipient')
                                    ->label('Nama Penerima / Pemenang')
                                    ->required()
                                    ->placeholder('Nama Siswa atau Tim')
                                    ->prefixIcon('heroicon-m-user')
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Catatan Tambahan')
                                    ->placeholder('Ceritakan sedikit tentang jalannya lomba atau pencapaian khusus...')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (PERINGKAT & BUKTI) ===
                Group::make()
                    ->schema([
                        Section::make('Capaian & Waktu')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                TextInput::make('rank')
                                    ->label('Peringkat Juara')
                                    ->placeholder('Cth: Juara 1 / Emas')
                                    ->prefixIcon('heroicon-m-star'),

                                Select::make('level')
                                    ->label('Tingkat')
                                    ->options([
                                        'Kecamatan' => 'Kecamatan',
                                        'Kabupaten' => 'Kabupaten/Kota',
                                        'Provinsi' => 'Provinsi',
                                        'Nasional' => 'Nasional',
                                        'Internasional' => 'Internasional',
                                    ])
                                    ->native(false)
                                    ->searchable(),

                                TextInput::make('year')
                                    ->label('Tahun Perolehan')
                                    ->numeric()
                                    ->default(date('Y'))
                                    ->prefixIcon('heroicon-m-calendar'),
                            ]),

                        Section::make('Dokumentasi')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Foto Penyerahan/Piala')
                                    ->image()
                                    ->directory('achievements')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('year', 'desc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->square()
                    ->size(60),

                TextColumn::make('title')
                    ->label('Nama Lomba')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (Achievement $record): string => $record->recipient ?? '-'),

                TextColumn::make('rank')
                    ->label('Juara')
                    ->badge()
                    ->color('warning') // Warna Emas/Kuning
                    ->icon('heroicon-m-trophy'),

                TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Internasional' => 'danger',  // Merah (Spesial)
                        'Nasional' => 'success',      // Hijau
                        'Provinsi' => 'info',         // Biru
                        default => 'gray',
                    }),

                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->color('gray'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')
                    ->options([
                        'Kecamatan' => 'Kecamatan',
                        'Kabupaten' => 'Kabupaten',
                        'Provinsi' => 'Provinsi',
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                    ]),
                Tables\Filters\SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(function () {
                        // Mengambil daftar tahun yang ada di database secara otomatis
                        return \App\Models\Achievement::query()
                            ->select('year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year', 'year')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}