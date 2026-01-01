<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicCalendarResource\Pages;
use App\Models\AcademicCalendar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;

class AcademicCalendarResource extends Resource
{
    use Translatable;
    protected static ?string $model = AcademicCalendar::class;

    // Ganti icon agar lebih spesifik (Calendar Date)
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    
    protected static ?string $navigationLabel = 'Kalender Akademik';
    
    protected static ?string $modelLabel = 'Agenda';

    protected static ?string $pluralModelLabel = 'Agenda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (DETAIL AGENDA) ===
                Group::make()
                    ->schema([
                        Section::make('Rincian Kegiatan')
                            ->description('Informasi utama mengenai agenda sekolah.')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Nama Agenda')
                                    ->placeholder('Contoh: Ujian Tengah Semester Ganjil')
                                    ->required()
                                    ->prefixIcon('heroicon-m-bookmark')
                                    ->columnSpanFull(),

                                Textarea::make('description')
                                    ->label('Keterangan Tambahan')
                                    ->placeholder('Tuliskan detail kegiatan jika diperlukan...')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (WAKTU & STATUS) ===
                Group::make()
                    ->schema([
                        Section::make('Waktu Pelaksanaan')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('Tanggal Mulai')
                                    ->required()
                                    ->native(false) // Tampilan kalender modern
                                    ->prefixIcon('heroicon-m-calendar'),

                                DatePicker::make('end_date')
                                    ->label('Tanggal Selesai')
                                    ->placeholder('Opsional (1 hari)')
                                    ->afterOrEqual('start_date') // Validasi
                                    ->native(false)
                                    ->prefixIcon('heroicon-m-calendar'),

                                Section::make()
                                    ->schema([
                                        Toggle::make('is_holiday')
                                            ->label('Hari Libur Nasional/Sekolah?')
                                            ->onColor('danger') // Merah jika libur
                                            ->offColor('success') // Hijau jika masuk
                                            ->inline(false)
                                            ->helperText('Aktifkan jika kegiatan ini meliburkan KBM.'),
                                    ])->compact(), // Tampilan compact tanpa border besar
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(3); // Layout Grid 3 Kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('start_date', 'asc')
            ->columns([
                // Kolom Tanggal dengan Format Rapi & Ikon
                TextColumn::make('start_date')
                    ->label('Waktu')
                    ->icon('heroicon-m-calendar-days')
                    ->formatStateUsing(function ($record) {
                        $start = \Carbon\Carbon::parse($record->start_date)->translatedFormat('d M Y');
                        
                        if ($record->end_date && $record->end_date != $record->start_date) {
                            $end = \Carbon\Carbon::parse($record->end_date)->translatedFormat('d M Y');
                            return "$start - $end";
                        }
                        return $start;
                    })
                    ->sortable(),

                // Kolom Judul Bold
                TextColumn::make('title')
                    ->label('Agenda')
                    ->weight('bold')
                    ->searchable(),

                // Status Badge (Lebih Informatif daripada sekadar Icon Checklist)
                TextColumn::make('is_holiday')
                    ->label('Status KBM')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'LIBUR' : 'MASUK')
                    ->color(fn (bool $state): string => $state ? 'danger' : 'success')
                    ->icon(fn (bool $state): string => $state ? 'heroicon-m-home' : 'heroicon-m-academic-cap'),
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
            'index' => Pages\ListAcademicCalendars::route('/'),
            'create' => Pages\CreateAcademicCalendar::route('/create'),
            'edit' => Pages\EditAcademicCalendar::route('/{record}/edit'),
        ];
    }
}