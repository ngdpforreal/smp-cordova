<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExtracurricularResource\Pages;
use App\Models\Extracurricular;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;

class ExtracurricularResource extends Resource
{
    use Translatable;
    protected static ?string $model = Extracurricular::class;

    // Icon piala/trophy agar terkesan "Prestasi & Bakat"
    protected static ?string $navigationIcon = 'heroicon-o-trophy';
    
    protected static ?string $navigationLabel = 'Ekstrakurikuler';
    
    protected static ?string $modelLabel = 'Kegiatan Ekskul';

    protected static ?string $pluralModelLabel = 'Kegiatan Eksul';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (DATA KEGIATAN) ===
                Group::make()
                    ->schema([
                        Section::make('Detail Kegiatan')
                            ->description('Informasi utama mengenai kegiatan ekstrakurikuler.')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Ekstrakurikuler')
                                    ->required()
                                    ->placeholder('Contoh: Pramuka, Futsal, Robotik')
                                    ->prefixIcon('heroicon-m-flag'),

                                TextInput::make('schedule')
                                    ->label('Jadwal Latihan')
                                    ->placeholder('Contoh: Setiap Selasa & Jumat, 15:30 WIB')
                                    ->prefixIcon('heroicon-m-clock')
                                    ->helperText('Tuliskan hari dan jam latihan secara jelas.'),

                                Textarea::make('description')
                                    ->label('Deskripsi Kegiatan')
                                    ->placeholder('Jelaskan apa saja yang dipelajari dan manfaat mengikuti ekskul ini...')
                                    ->rows(5)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (MEDIA) ===
                Group::make()
                    ->schema([
                        Section::make('Visualisasi')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Foto / Ikon Kegiatan')
                                    ->image()
                                    ->directory('extracurriculars')
                                    ->imageEditor() // Fitur edit foto bawaan
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(3); // Layout Grid 3 Kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->square()
                    ->size(60), // Ukuran sedikit lebih besar agar jelas

                TextColumn::make('name')
                    ->label('Nama Ekskul')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                // Menambahkan kolom Jadwal di tabel agar informatif
                TextColumn::make('schedule')
                    ->label('Jadwal')
                    ->icon('heroicon-m-calendar-days')
                    ->color('gray')
                    ->limit(30),
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
            'index' => Pages\ListExtracurriculars::route('/'),
            'create' => Pages\CreateExtracurricular::route('/create'),
            'edit' => Pages\EditExtracurricular::route('/{record}/edit'),
        ];
    }
}