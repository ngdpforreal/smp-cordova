<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolSettingResource\Pages;
use App\Models\SchoolSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\FileUpload;

class SchoolSettingResource extends Resource
{
    protected static ?string $model = SchoolSetting::class;
    
    // Icon Building / Gedung
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2'; 
    protected static ?string $navigationLabel = 'Identitas Sekolah';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (DATA UTAMA) ===
                Group::make()
                    ->schema([
                        Section::make('Kontak & Alamat')
                            ->description('Informasi ini akan ditampilkan di Footer dan Halaman Kontak.')
                            ->icon('heroicon-o-map-pin')
                            ->schema([
                                Forms\Components\TextInput::make('email')
                                    ->label('Email Resmi')
                                    ->email()
                                    ->required()
                                    ->prefixIcon('heroicon-m-envelope')
                                    ->placeholder('admin@sekolah.sch.id'),
                                
                                Forms\Components\TextInput::make('phone')
                                    ->label('No. Telepon / WhatsApp')
                                    ->tel()
                                    ->required()
                                    ->prefixIcon('heroicon-m-phone')
                                    ->placeholder('+62 812...'),

                                Forms\Components\Textarea::make('address')
                                    ->label('Alamat Lengkap')
                                    ->rows(3)
                                    ->required()
                                    ->columnSpanFull()
                                    ->placeholder('Jl. Contoh No. 123...'),
                            ])->columns(2),

                        Section::make('Media Sosial')
                            ->description('Link ke akun sosial media resmi sekolah.')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Forms\Components\TextInput::make('facebook')
                                    ->prefix('fb.com/')
                                    ->prefixIcon('heroicon-m-globe-alt'),
                                
                                Forms\Components\TextInput::make('instagram')
                                    ->prefix('instagram.com/')
                                    ->prefixIcon('heroicon-m-camera'),
                                
                                Forms\Components\TextInput::make('youtube')
                                    ->prefix('youtube.com/')
                                    ->prefixIcon('heroicon-m-play'),
                                    
                                Forms\Components\TextInput::make('twitter')
                                    ->label('Twitter / X')
                                    ->prefix('x.com/')
                                    ->placeholder('username'),
                            ])->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]), // Lebar 2/3 di layar besar

                // === KOLOM KANAN (MAPS & BANTUAN) ===
                Group::make()
                    ->schema([
                        Section::make('Integrasi Peta')
                            ->description('Tampilan Google Maps di website.')
                            ->icon('heroicon-o-map')
                            ->schema([
                                Forms\Components\Placeholder::make('tutorial')
                                    ->label('Cara Mengambil Embed Code:')
                                    ->content(new \Illuminate\Support\HtmlString('
                                        <ol class="list-decimal list-inside text-sm text-gray-500 space-y-1">
                                            <li>Buka <b>Google Maps</b>.</li>
                                            <li>Cari lokasi sekolah.</li>
                                            <li>Klik tombol <b>Bagikan (Share)</b>.</li>
                                            <li>Pilih <b>Sematkan Peta (Embed)</b>.</li>
                                            <li>Salin kode HTML (iframe).</li>
                                        </ol>
                                    ')),
                                
                                Forms\Components\Textarea::make('maps_embed')
                                    ->label('Kode HTML Iframe')
                                    ->rows(8)
                                    ->placeholder('<iframe src="https://www.google.com/maps/embed?...')
                                    ->columnSpanFull()
                                    ->helperText('Pastikan kode diawali dengan <iframe...'),
                            ]),
                        Section::make('Download Brosur')
                            ->description('File PDF/Gambar yang bisa didownload pengunjung.')
                            ->icon('heroicon-o-arrow-down-tray')
                            ->schema([
                                FileUpload::make('brochure')
                                    ->label('File Brosur (PDF)')
                                    ->directory('brochures')
                                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])
                                    ->maxSize(5120) // Maks 5MB
                                    ->downloadable()
                                    ->openable()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]), // Lebar 1/3 di layar besar

            ])
            ->columns(3); // Total Grid 3 Kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->description('Email Utama'),
                    
                Tables\Columns\TextColumn::make('phone')
                    ->icon('heroicon-m-phone')
                    ->description('Telepon'),
                    
                Tables\Columns\TextColumn::make('address')
                    ->limit(30)
                    ->icon('heroicon-m-map-pin')
                    ->label('Alamat'),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]); 
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSchoolSettings::route('/'),
            'create' => Pages\CreateSchoolSetting::route('/create'),
            'edit' => Pages\EditSchoolSetting::route('/{record}/edit'),
        ];
    }
}