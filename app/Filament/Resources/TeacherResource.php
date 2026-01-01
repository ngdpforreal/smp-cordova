<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group; // Penting untuk layout
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Concerns\Translatable;

class TeacherResource extends Resource
{
    use Translatable;
    protected static ?string $model = Teacher::class;

    // Ganti Icon agar lebih relevan (User Group / Academic Cap)
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationLabel = 'Data Guru & Staff';
    
    protected static ?string $modelLabel = 'Pengajar & Staff';

    protected static ?string $pluralModelLabel = 'Pengajar & Staff';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (UTAMA - 2/3 Layar) ===
                Group::make()
                    ->schema([
                        
                        // 1. Section Informasi Dasar
                        Section::make('Informasi Pribadi')
                            ->description('Data identitas utama pengajar atau staff.')
                            ->icon('heroicon-o-user')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Lengkap & Gelar')
                                    ->required()
                                    ->placeholder('Cth: Dr. Hariyanto, M.Pd')
                                    ->prefixIcon('heroicon-m-user'),

                                Grid::make(2)->schema([
                                    Forms\Components\TextInput::make('position')
                                        ->label('Jabatan / Mata Pelajaran')
                                        ->placeholder('Cth: Guru Matematika')
                                        ->prefixIcon('heroicon-m-briefcase'),
                                    
                                    Forms\Components\TextInput::make('education')
                                        ->label('Pendidikan Terakhir')
                                        ->placeholder('Cth: S1 Pendidikan - Univ. Negeri Malang')
                                        ->prefixIcon('heroicon-m-academic-cap'),
                                ]),

                                Forms\Components\Textarea::make('bio')
                                    ->label('Biografi Singkat / Sambutan')
                                    ->rows(4)
                                    ->placeholder('Tuliskan deskripsi singkat atau kata sambutan...')
                                    ->columnSpanFull(),
                            ]),

                        // 2. Section Media Sosial (Collapsible agar rapi)
                        Section::make('Jejak Digital & Kontak')
                            ->description('Tautan media sosial untuk ditampilkan di profil.')
                            ->icon('heroicon-o-share')
                            ->collapsible() 
                            ->collapsed(false) // Default terbuka
                            ->schema([
                                Grid::make(3)->schema([
                                    Forms\Components\TextInput::make('facebook')
                                        ->prefix('facebook.com/')
                                        ->placeholder('username'),
                                    
                                    Forms\Components\TextInput::make('instagram')
                                        ->prefix('instagram.com/')
                                        ->placeholder('username'),
                                        
                                    Forms\Components\TextInput::make('linkedin')
                                        ->prefix('linkedin.com/in/')
                                        ->placeholder('username'),
                                ]),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]), // Ambil 2 kolom di layar besar


                // === KOLOM KANAN (SIDEBAR - 1/3 Layar) ===
                Group::make()
                    ->schema([
                        
                        // 1. Section Status & Kategori
                        Section::make('Status Kepegawaian')
                            ->icon('heroicon-o-tag')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Kelompok')
                                    ->options([
                                        'pimpinan' => 'Pimpinan / Struktural',
                                        'guru' => 'Dewan Guru',
                                        'staff' => 'Staff / Tata Usaha',
                                    ])
                                    ->required()
                                    ->native(false) // Tampilan dropdown lebih modern
                                    ->selectablePlaceholder(false),
                            ]),

                        // 2. Section Foto
                        Section::make('Foto Profil')
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->label('Upload Foto')
                                    ->image()
                                    ->avatar() // Tampilan bulat saat upload
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                        '3:4', // Portrait
                                    ])
                                    ->directory('teachers')
                                    ->columnSpanFull()
                                    ->alignCenter(), // Posisi tengah
                            ]),

                        // 3. Section Dokumen
                        Section::make('Berkas Pendukung')
                            ->schema([
                                Forms\Components\FileUpload::make('cv_file')
                                    ->label('Curriculum Vitae (CV)')
                                    ->directory('teachers/cv')
                                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                                    ->maxSize(5120)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]), // Ambil 1 kolom di layar besar

            ])
            ->columns(3); // Total grid layout adalah 3 kolom
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order') // Fitur Drag & Drop Urutan
            ->defaultSort('order', 'asc')
            ->columns([
                // Kolom Foto
                ImageColumn::make('photo')
                    ->circular()
                    ->label('')
                    ->defaultImageUrl(url('/images/logo-smp.png')), // Fallback image jika kosong
                
                // Kolom Nama & Jabatan (Stacked)
                TextColumn::make('name')
                    ->label('Nama Pengajar')
                    ->searchable()
                    ->sortable()
                    ->description(fn (Teacher $record): string => $record->position ?? '-')
                    ->weight('bold'),

                // Kolom Tipe (Badge Warna-warni)
                TextColumn::make('type')
                    ->badge()
                    ->label('Kategori')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pimpinan' => 'Pimpinan',
                        'guru' => 'Guru',
                        'staff' => 'Staff',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pimpinan' => 'warning', // Kuning/Emas
                        'guru' => 'success',     // Hijau
                        'staff' => 'gray',       // Abu-abu
                        default => 'gray',
                    }),
                
                // Indikator punya CV atau tidak
                Tables\Columns\IconColumn::make('cv_file')
                    ->label('CV')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->alignCenter(),
            ])
            ->filters([
                // Filter dropdown di atas tabel
                Tables\Filters\SelectFilter::make('type')
                    ->label('Filter Kategori')
                    ->options([
                        'pimpinan' => 'Pimpinan',
                        'guru' => 'Dewan Guru',
                        'staff' => 'Staff TU',
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}