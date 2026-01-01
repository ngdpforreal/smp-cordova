<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
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

class GalleryResource extends Resource
{
    use Translatable;
    protected static ?string $model = Gallery::class;

    // Icon Foto/Kamera yang lebih relevan
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    
    protected static ?string $navigationLabel = 'Galeri Foto';
    
    protected static ?string $modelLabel = 'Foto';

    protected static ?string $pluralModelLabel = 'Foto';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (INFO UTAMA) ===
                Group::make()
                    ->schema([
                        Section::make('Informasi Foto')
                            ->description('Judul dan deskripsi untuk dokumentasi.')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Foto')
                                    ->required()
                                    ->placeholder('Contoh: Kegiatan Upacara Bendera')
                                    ->prefixIcon('heroicon-m-camera')
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Deskripsi (Caption)')
                                    ->placeholder('Tuliskan keterangan singkat mengenai momen ini...')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (UPLOAD & KATEGORI) ===
                Group::make()
                    ->schema([
                        Section::make('Media & Kategori')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Select::make('category')
                                    ->label('Album Kategori')
                                    ->options([
                                        'fasilitas' => 'Fasilitas Sekolah',
                                        'kegiatan'  => 'Kegiatan Santri',
                                        'prestasi'  => 'Dokumentasi Prestasi',
                                    ])
                                    ->required()
                                    ->native(false) // Dropdown modern
                                    ->prefixIcon('heroicon-m-tag'),

                                FileUpload::make('file_path')
                                    ->label('File Foto')
                                    ->image()
                                    ->directory('galleries')
                                    ->imageEditor() // Fitur edit/crop
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->required()
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
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Foto')
                    ->square()
                    ->size(80), // Ukuran preview lebih besar agar jelas

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (Gallery $record): string => \Illuminate\Support\Str::limit($record->description, 30) ?? ''),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'fasilitas' => 'info',     // Biru
                        'kegiatan' => 'success',   // Hijau
                        'prestasi' => 'warning',   // Kuning
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'fasilitas' => 'heroicon-m-building-office',
                        'kegiatan' => 'heroicon-m-user-group',
                        'prestasi' => 'heroicon-m-trophy',
                        default => 'heroicon-m-photo',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter Album')
                    ->options([
                        'fasilitas' => 'Fasilitas',
                        'kegiatan' => 'Kegiatan',
                        'prestasi' => 'Prestasi',
                    ]),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}