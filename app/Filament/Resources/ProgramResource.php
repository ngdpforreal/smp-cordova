<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Concerns\Translatable;

class ProgramResource extends Resource
{
    use Translatable;
    protected static ?string $model = Program::class;

    // Ganti icon ke 'Sparkles' untuk kesan "Unggulan"
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    
    protected static ?string $navigationLabel = 'Program Unggulan';
    
    protected static ?string $modelLabel = 'Program';

    protected static ?string $pluralModelLabel = 'Program';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (INFO UTAMA) ===
                Group::make()
                    ->schema([
                        Section::make('Detail Program')
                            ->description('Informasi mengenai program pendidikan unggulan.')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Nama Program')
                                    ->required()
                                    ->placeholder('Contoh: Tahfidz Al-Quran')
                                    ->prefixIcon('heroicon-m-academic-cap')
                                    ->maxLength(255),

                                Textarea::make('description')
                                    ->label('Deskripsi Singkat')
                                    ->required()
                                    ->rows(5)
                                    ->placeholder('Jelaskan keunggulan dan target dari program ini...')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (VISUAL) ===
                Group::make()
                    ->schema([
                        Section::make('Visualisasi')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Select::make('icon')
                                    ->label('Ikon Ilustrasi')
                                    ->options([
                                        'globe' => 'Bola Dunia (Internasional)',
                                        'book-open' => 'Buku Terbuka (Akademik)',
                                        'cpu' => 'Chip / Komputer (Teknologi)',
                                        'chat' => 'Chat / Diskusi (Bahasa)',
                                        'user-group' => 'Orang / Karakter (Sosial)',
                                        'star' => 'Bintang (Prestasi)',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->searchable()
                                    ->prefixIcon('heroicon-m-star'),

                                FileUpload::make('image')
                                    ->label('Gambar Cover')
                                    ->image()
                                    ->directory('programs')
                                    ->imageEditor() // Fitur crop/rotate bawaan
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(3); // Layout Grid 3 Kolom (2+1)
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Cover')
                    ->square()
                    ->size(50),

                TextColumn::make('title')
                    ->label('Nama Program')
                    ->searchable()
                    ->weight('bold')
                    ->sortable(),

                // Menampilkan Badge dengan Icon yang sesuai
                TextColumn::make('icon')
                    ->label('Ikon')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'globe' => 'Bola Dunia',
                        'book-open' => 'Buku',
                        'cpu' => 'Teknologi',
                        'chat' => 'Bahasa',
                        'user-group' => 'Sosial',
                        'star' => 'Prestasi',
                        default => $state,
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'globe' => 'heroicon-m-globe-alt',
                        'book-open' => 'heroicon-m-book-open',
                        'cpu' => 'heroicon-m-cpu-chip',
                        'chat' => 'heroicon-m-chat-bubble-left-right',
                        'user-group' => 'heroicon-m-user-group',
                        'star' => 'heroicon-m-star',
                        default => 'heroicon-m-question-mark-circle',
                    }),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50) // Batasi teks agar tabel tidak berantakan
                    ->color('gray')
                    ->toggleable(),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}