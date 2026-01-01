<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    // Icon surat yang lebih modern
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right'; 
    
    protected static ?string $navigationLabel = 'Pesan Masuk';
    
    protected static ?string $modelLabel = 'Pesan';

    protected static ?string $pluralModelLabel = 'Pesan';

    protected static ?int $navigationSort = 3; 

    // === TAMPILAN TABEL (LIST) ===
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom Nama & Email digabung agar rapi
                Tables\Columns\TextColumn::make('name')
                    ->label('Pengirim')
                    ->description(fn (ContactMessage $record) => $record->email)
                    ->searchable(['name', 'email'])
                    ->weight('bold')
                    ->icon('heroicon-m-user-circle')
                    ->color('gray'),

                // Kategori dengan Icon & Warna
                Tables\Columns\TextColumn::make('subject')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Kritik & Saran' => 'warning',
                        'PPDB' => 'success',
                        'Pertanyaan Umum' => 'info',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'Kritik & Saran' => 'heroicon-m-exclamation-circle',
                        'PPDB' => 'heroicon-m-academic-cap',
                        'Pertanyaan Umum' => 'heroicon-m-question-mark-circle',
                        default => 'heroicon-m-tag',
                    }),

                // Cuplikan Pesan (dibatasi 50 karakter)
                Tables\Columns\TextColumn::make('message')
                    ->label('Isi Pesan')
                    ->limit(50)
                    ->icon('heroicon-m-document-text')
                    ->color('gray'),

                // Waktu yang user-friendly (cth: "2 jam yang lalu")
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diterima')
                    ->since() 
                    ->sortable()
                    ->dateTimeTooltip()
                    ->icon('heroicon-m-clock'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make()->label('Lihat'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    // === TAMPILAN DETAIL (POPUP/PAGE) ===
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Group::make()
                    ->schema([
                        // Section Informasi Pengirim
                        Infolists\Components\Section::make('Informasi Pengirim')
                            ->icon('heroicon-m-identification')
                            ->schema([
                                Infolists\Components\TextEntry::make('name')
                                    ->label('Nama Lengkap')
                                    ->weight('bold'),
                                
                                Infolists\Components\TextEntry::make('email')
                                    ->label('Email')
                                    ->icon('heroicon-m-envelope')
                                    ->copyable(),
                                
                                Infolists\Components\TextEntry::make('phone')
                                    ->label('WhatsApp / Telepon')
                                    ->icon('heroicon-m-phone')
                                    ->placeholder('Tidak dicantumkan'),
                                
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('Waktu Masuk')
                                    ->dateTime('d F Y, H:i WIB')
                                    ->badge()
                                    ->color('gray'),
                            ])->columns(2),
                        
                        // Section Isi Pesan
                        Infolists\Components\Section::make('Isi Pesan')
                            ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
                            ->schema([
                                Infolists\Components\TextEntry::make('subject')
                                    ->label('Subjek / Kategori')
                                    ->weight('bold')
                                    ->size(Infolists\Components\TextEntry\TextEntrySize::Large),
                                    
                                Infolists\Components\TextEntry::make('message')
                                    ->hiddenLabel()
                                    ->prose() // Menggunakan font typography yang enak dibaca
                                    ->markdown()
                                    ->columnSpanFull(),
                            ]),
                    ])->columnSpanFull()
            ]);
    }
    
    public static function canCreate(): bool
    {
        return false;
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),
            // Kita gunakan Modal View (Popup) jadi tidak perlu halaman view terpisah
        ];
    }
}