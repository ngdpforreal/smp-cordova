<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
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
use Filament\Tables\Columns\ToggleColumn;
use Filament\Resources\Concerns\Translatable;

class TestimonialResource extends Resource
{
    use Translatable;
    protected static ?string $model = Testimonial::class;

    // Icon Chat/Kutipan
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    
    protected static ?string $navigationLabel = 'Testimoni';
    
    protected static ?string $modelLabel = 'Testimoni';

    protected static ?string $pluralModelLabel = 'Testimoni';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (ISI TESTIMONI) ===
                Group::make()
                    ->schema([
                        Section::make('Identitas Pemberi')
                            ->description('Siapa yang memberikan ulasan ini?')
                            ->icon('heroicon-o-user-circle')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->placeholder('Contoh: Bpk. Suryanto')
                                    ->prefixIcon('heroicon-m-user'),

                                TextInput::make('role')
                                    ->label('Status / Jabatan')
                                    ->required()
                                    ->placeholder('Contoh: Wali Murid Kelas 9 / Alumni 2023')
                                    ->prefixIcon('heroicon-m-identification'),

                                Textarea::make('content')
                                    ->label('Isi Testimoni')
                                    ->required()
                                    ->placeholder('Tuliskan kesan dan pesan mereka terhadap sekolah...')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (RATING & FOTO) ===
                Group::make()
                    ->schema([
                        Section::make('Penilaian')
                            ->icon('heroicon-o-star')
                            ->schema([
                                Select::make('rating')
                                    ->label('Rating Bintang')
                                    ->options([
                                        5 => '(Sempurna)',
                                        4 => '(Sangat Baik)',
                                        3 => '(Baik)',
                                        2 => '(Cukup)',
                                        1 => '(Kurang)',
                                    ])
                                    ->default(5)
                                    ->required()
                                    ->native(false),

                                FileUpload::make('photo')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->avatar() // Crop bulat otomatis
                                    ->imageEditor()
                                    ->directory('testimonials')
                                    ->columnSpanFull()
                                    ->alignCenter(),
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
                ImageColumn::make('photo')
                    ->label('')
                    ->circular()
                    ->size(40),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (Testimonial $record): string => $record->role ?? '-'),

                TextColumn::make('rating')
                    ->label('Rating')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '5', '4' => 'success', // Hijau
                        '3' => 'warning',      // Kuning
                        default => 'danger',   // Merah
                    })
                    ->formatStateUsing(fn (string $state): string => str_repeat('★', $state)), // Ubah angka jadi bintang

                TextColumn::make('content')
                    ->label('Isi Ulasan')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->color('gray'),
                ToggleColumn::make('is_published')
                ->label('Status Approve')
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
            ])
            ->filters([
            // Filter agar admin bisa melihat mana yang belum di-approve
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publikasi')
                    ->placeholder('Semua Testimoni')
                    ->trueLabel('Sudah Disetujui')
                    ->falseLabel('Menunggu Persetujuan'),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}