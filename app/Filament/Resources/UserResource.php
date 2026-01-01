<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // Ikon Shield/User agar terkesan sebagai "System Admin"
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    
    protected static ?string $navigationLabel = 'Manajemen Admin';
    
    protected static ?string $navigationGroup = 'Pengaturan Sistem';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                // === KOLOM KIRI (AKSES & IDENTITAS) ===
                Group::make()
                    ->schema([
                        Section::make('Informasi Akun Admin')
                            ->description('Kelola identitas login dan akses keamanan sistem.')
                            ->icon('heroicon-o-finger-print')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->placeholder('Cth: Admin Satria')
                                    ->required()
                                    ->prefixIcon('heroicon-m-user'),
                                
                                Forms\Components\TextInput::make('email')
                                    ->label('Alamat Email')
                                    ->placeholder('admin@sekolah.sch.id')
                                    ->email()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->prefixIcon('heroicon-m-envelope'),

                                Forms\Components\TextInput::make('password')
                                    ->label('Password Baru')
                                    ->password()
                                    ->placeholder('••••••••')
                                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context): bool => $context === 'create')
                                    ->prefixIcon('heroicon-m-lock-closed')
                                    ->helperText('Kosongkan jika tidak ingin mengubah password lama.'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // === KOLOM KANAN (FOTO PROFIL) ===
                Group::make()
                    ->schema([
                        Section::make('Foto Profil')
                            ->description('Muncul di navbar pojok kanan.')
                            ->icon('heroicon-o-face-smile')
                            ->schema([
                                Forms\Components\FileUpload::make('avatar_url')
                                    ->label('Foto Admin')
                                    ->image()
                                    ->avatar() // UI Bulat saat upload
                                    ->imageEditor() // Memungkinkan crop/zoom foto
                                    ->directory('avatars')
                                    ->alignCenter()
                                    ->columnSpanFull(),
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
                ImageColumn::make('avatar_url')
                    ->label('')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('/images/logo.png')), // Fallback ke logo sekolah jika foto kosong

                TextColumn::make('name')
                    ->label('Nama Admin')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('email')
                    ->label('Email Address')
                    ->icon('heroicon-m-envelope')
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Terdaftar Sejak')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color('gray'),
            ])
            ->filters([
                //
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
            'index' => \App\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \App\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \App\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}