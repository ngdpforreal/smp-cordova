<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Set;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Resources\Concerns\Translatable;

class PostResource extends Resource
{
    use Translatable;
    protected static ?string $model = Post::class;

    // Icon koran/berita agar lebih representatif
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    
    protected static ?string $navigationLabel = 'Berita & Artikel';
    
    protected static ?string $modelLabel = 'Artikel';

    protected static ?string $pluralModelLabel = 'Artikel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (KONTEN UTAMA - 2/3) ===
                Group::make()
                    ->schema([
                        Section::make('Konten Artikel')
                            ->description('Tulis judul dan isi artikel yang informatif.')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextInput::make('title')
                                ->label('Judul Artikel')
                                ->required()
                                ->placeholder('Contoh: Prestasi Siswa')
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                    // HANYA update slug jika slug masih kosong
                                    // Ini mencegah slug berubah saat Anda mengedit judul terjemahan (EN)
                                    if (filled($state) && blank($get('slug'))) {
                                        $set('slug', Str::slug($state));
                                    }
                                })
                                ->prefixIcon('heroicon-m-pencil-square'),

                                TextInput::make('slug')
                                    ->label('Link Permanen (Slug)')
                                    ->disabled() 
                                    ->dehydrated() 
                                    ->unique(Post::class, 'slug', ignoreRecord: true)
                                    ->prefix(url('/berita/').'/')
                                    ->helperText('Link dibuat otomatis dari judul bahasa utama. Edit manual jika perlu.'),

                                TiptapEditor::make('content')
                                    ->label('Isi Artikel')
                                    ->required()
                                    ->profile('default')
                                    ->disk('public')
                                    ->directory('posts')
                                    ->visibility('public')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (SIDEBAR - 1/3) ===
                Group::make()
                    ->schema([
                        
                        Section::make('Gambar Utama')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Cover Image')
                                    ->image()
                                    ->directory('posts')
                                    ->imageEditor()
                                    ->columnSpanFull(),
                            ])
                            ->collapsible(),

                        Section::make('Pengaturan Publikasi')
                            ->icon('heroicon-o-globe-alt')
                            ->schema([
                                Select::make('category')
                                    ->label('Kategori')
                                    ->options([
                                        'berita' => 'Berita Sekolah',
                                        'artikel' => 'Artikel Islami',
                                        'agenda' => 'Agenda Kegiatan',
                                        'pengumuman' => 'Pengumuman',
                                    ])
                                    ->required()
                                    ->native(false)
                                    ->prefixIcon('heroicon-m-tag'),

                                Select::make('status')
                                    ->label('Status')
                                    ->options([
                                        'draft' => 'Draft (Simpan Dulu)',
                                        'published' => 'Terbit (Public)',
                                    ])
                                    ->default('published')
                                    ->required()
                                    ->native(false)
                                    ->prefixIcon('heroicon-m-check-circle'),

                                DatePicker::make('published_at')
                                    ->label('Tanggal Terbit')
                                    ->default(now())
                                    ->required()
                                    ->prefixIcon('heroicon-m-calendar'),

                                // Hidden: User ID otomatis
                                Hidden::make('user_id')
                                    ->default(fn () => auth()->id()),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),

            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('published_at', 'desc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Cover')
                    ->square()
                    ->size(50),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('bold')
                    ->limit(40)
                    ->description(fn (Post $record): string => Str::limit(\App\Helpers\TiptapParser::toText($record->content), 40)),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'berita' => 'info',
                        'artikel' => 'success',
                        'agenda' => 'warning',
                        'pengumuman' => 'danger',
                        default => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'berita' => 'heroicon-m-newspaper',
                        'agenda' => 'heroicon-m-calendar',
                        default => 'heroicon-m-tag',
                    }),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options([
                        'berita' => 'Berita',
                        'artikel' => 'Artikel',
                        'agenda' => 'Agenda',
                        'pengumuman' => 'Pengumuman',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}