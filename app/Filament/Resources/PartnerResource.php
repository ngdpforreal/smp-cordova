<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised'; // Ikon jabat tangan/kemitraan
    protected static ?string $navigationLabel = 'Kemitraan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // === KOLOM KIRI (DATA MITRA) ===
                Group::make()
                    ->schema([
                        Section::make('Informasi Mitra')
                            ->description('Masukkan detail instansi atau perusahaan mitra.')
                            ->icon('heroicon-o-building-office')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Instansi')
                                    ->required()
                                    ->placeholder('Cth: Universitas Indonesia / Bank Syariah')
                                    ->prefixIcon('heroicon-m-briefcase'),

                                Forms\Components\TextInput::make('website')
                                    ->label('Link Website (Opsional)')
                                    ->url()
                                    ->placeholder('https://www.mitra.com')
                                    ->prefixIcon('heroicon-m-link'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (LOGO & STATUS) ===
                Group::make()
                    ->schema([
                        Section::make('Visual & Status')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->label('Logo Mitra')
                                    ->image()
                                    ->directory('partners')
                                    ->imageEditor()
                                    ->required()
                                    ->helperText('Gunakan format PNG transparan untuk hasil terbaik.'),

                                Forms\Components\Toggle::make('is_active')
                                    ->label('Tampilkan di Web')
                                    ->default(true)
                                    ->onColor('success'),

                                Forms\Components\TextInput::make('order')
                                    ->label('Urutan')
                                    ->numeric()
                                    ->default(0)
                                    ->prefixIcon('heroicon-m-numbered-list'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->defaultSort('order', 'asc')
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->square(),
                
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Mitra')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Resources\PartnerResource\Pages\ListPartners::route('/'),
            'create' => \App\Filament\Resources\PartnerResource\Pages\CreatePartner::route('/create'),
            'edit' => \App\Filament\Resources\PartnerResource\Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}