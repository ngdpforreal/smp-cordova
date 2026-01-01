<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SliderResource\Pages;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Resources\Concerns\Translatable;

class SliderResource extends Resource
{
    use Translatable;
    protected static ?string $model = Slider::class;

    // Icon Presentasi/Layar Lebar
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    
    protected static ?string $navigationLabel = 'Slider Beranda';
    
    protected static ?string $modelLabel = 'Slide';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (TEKS & KONTEN) ===
                Group::make()
                    ->schema([
                        Section::make('Konten Slide')
                            ->description('Teks utama yang akan muncul di atas gambar.')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Besar (Headline)')
                                    ->required()
                                    ->placeholder('Contoh: PPDB Telah Dibuka')
                                    ->prefixIcon('heroicon-m-megaphone')
                                    ->maxLength(255),

                                Textarea::make('subtitle')
                                    ->label('Sub Judul (Deskripsi)')
                                    ->placeholder('Contoh: Segera daftarkan putra-putri Anda sekarang juga.')
                                    ->rows(3)
                                    ->maxLength(255),
                            ]),

                    Section::make('Konfigurasi Tombol')
                        ->description('Atur tombol aksi (CTA) pada slider.')
                        ->icon('heroicon-o-cursor-arrow-rays')
                        ->schema([
                            // === TOMBOL UTAMA (EMAS) ===
                            Forms\Components\Fieldset::make('Tombol Utama (Warna Emas)')
                                ->schema([
                                    TextInput::make('button_text')
                                        ->label('Teks Tombol 1')
                                        ->placeholder('Cth: Jelajahi Sekolah')
                                        ->prefixIcon('heroicon-m-tag'),

                                    TextInput::make('button_link')
                                        ->label('Link Tujuan 1')
                                        ->placeholder('https://...')
                                        ->prefixIcon('heroicon-m-link'),

                                    Toggle::make('open_new_tab')
                                        ->label('Buka di Tab Baru?')
                                        ->default(false)
                                        ->inline(false),
                                ])
                                ->columns(3), // 3 Kolom agar rapi

                            // === TOMBOL KEDUA (TRANSPARAN) ===
                            Forms\Components\Fieldset::make('Tombol Kedua (Transparan/Outline)')
                                ->schema([
                                    TextInput::make('button2_text')
                                        ->label('Teks Tombol 2')
                                        ->placeholder('Cth: Video Profil')
                                        ->helperText('Kosongkan jika tidak ingin menampilkan tombol kedua.')
                                        ->prefixIcon('heroicon-m-play'),

                                    TextInput::make('button2_link')
                                        ->label('Link Tujuan 2')
                                        ->placeholder('https://youtube.com/...')
                                        ->prefixIcon('heroicon-m-link'),

                                    Toggle::make('button2_new_tab')
                                        ->label('Buka di Tab Baru?')
                                        ->default(true) // Biasanya video dibuka di tab baru
                                        ->inline(false),
                                ])
                                ->columns(3),
                        ])
                        ->collapsible(),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (VISUAL & PENGATURAN) ===
                Group::make()
                    ->schema([
                        Section::make('Visual Background')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Gambar Banner')
                                    ->image()
                                    ->directory('sliders')
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '16:9', // Standar Banner Web
                                    ])
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Section::make('Pengaturan Tayang')
                            ->schema([
                                Toggle::make('is_active')
                                    ->label('Terbitkan?')
                                    ->onColor('success')
                                    ->offColor('danger')
                                    ->default(true)
                                    ->inline(false),

                                TextInput::make('order')
                                    ->label('Urutan Tampil')
                                    ->numeric()
                                    ->default(0)
                                    ->prefixIcon('heroicon-m-numbered-list')
                                    ->helperText('Angka kecil akan tampil lebih dulu.'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order') // Drag & Drop Urutan
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Banner')
                    ->height(60) // Tampil lebih lebar/tinggi
                    ->extraImgAttributes(['class' => 'object-cover rounded-md']),

                TextColumn::make('title')
                    ->label('Judul Headline')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (Slider $record): string => $record->subtitle ?? '-'),

                // Toggle Langsung di Tabel (Sangat Praktis)
                ToggleColumn::make('is_active')
                    ->label('Status Aktif')
                    ->onColor('success')
                    ->offColor('danger'),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}