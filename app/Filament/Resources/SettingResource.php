<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;

class SettingResource extends Resource
{
    use Translatable;
    protected static ?string $model = Setting::class;

    // Icon Gear/Gerigi khas Pengaturan
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    
    protected static ?string $navigationLabel = 'Pengaturan Web';
    
    protected static ?string $modelLabel = 'Pengaturan';

    protected static ?string $pluralModelLabel = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (ISI PENGATURAN) ===
                Group::make()
                    ->schema([
                        Section::make('Isi Konfigurasi')
                            ->description('Ubah nilai pengaturan website di sini.')
                            ->icon('heroicon-o-adjustments-horizontal')
                            ->schema([
                                Textarea::make('value')
                                    ->label('Nilai / Isi (Value)')
                                    ->required()
                                    ->placeholder('Masukkan nilai pengaturan...')
                                    ->rows(6)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (METADATA TEKNIS) ===
                Group::make()
                    ->schema([
                        Section::make('Identitas Kunci')
                            ->description('Parameter sistem (Hati-hati saat mengubah).')
                            ->icon('heroicon-o-key')
                            ->schema([
                                TextInput::make('key')
                                    ->label('Kunci (Key)')
                                    ->required()
                                    ->placeholder('contoh: app_name')
                                    ->prefixIcon('heroicon-m-key')
                                    ->maxLength(255)
                                    ->helperText('Digunakan oleh sistem untuk memanggil data.'),

                                Select::make('type')
                                    ->label('Tipe Data')
                                    ->options([
                                        'text' => 'Teks Singkat',
                                        'long_text' => 'Teks Panjang',
                                        'html' => 'HTML / Rich Text',
                                        'number' => 'Angka / Nominal',
                                        'link' => 'Tautan URL',
                                    ])
                                    ->default('text')
                                    ->required()
                                    ->native(false)
                                    ->prefixIcon('heroicon-m-tag'),
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
                TextColumn::make('key')
                    ->label('Nama Pengaturan')
                    ->searchable()
                    ->weight('bold')
                    ->copyable() // Fitur copy key untuk developer
                    ->copyMessage('Key disalin!')
                    ->icon('heroicon-m-key'),

                TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(50)
                    ->searchable()
                    ->color('gray'),

                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'info',
                        'number' => 'success',
                        'link' => 'warning',
                        'html' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('updated_at')
                    ->label('Terakhir Ubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter berdasarkan Tipe Data
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'text' => 'Teks',
                        'number' => 'Angka',
                        'link' => 'Link',
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}