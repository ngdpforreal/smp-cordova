<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;
use Filament\SpatieLaravelTranslatablePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            
            // === 1. BRANDING ===
            ->brandName('SMP Plus Cordova')
            ->brandLogo(asset('images/smpplus.png')) 
            ->brandLogoHeight('4rem')
            ->favicon(asset('images/favicon.png'))

            // === 2. UI TWEAKS ===
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font('Poppins')
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full')
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])

            // === 3. PREMIUM LOGIN STYLE (FIXED DOUBLE BORDER) ===
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => request()->routeIs('filament.admin.auth.login') 
                    ? Blade::render('
                        <style>
                            /* === ANIMASI MASUK === */
                            @keyframes slideUpFade {
                                from { opacity: 0; transform: translateY(20px); }
                                to { opacity: 1; transform: translateY(0); }
                            }

                            body {
                                background-color: #f8fafc;
                                font-family: "Poppins", sans-serif;
                            }

                            /* === TAMPILAN KHUSUS DESKTOP === */
                            @media (min-width: 1024px) {
                                body {
                                    display: flex;
                                    height: 100vh;
                                    overflow: hidden;
                                }

                                /* BAGIAN KIRI: GAMBAR FULL HEIGHT */
                                body::before {
                                    content: "";
                                    position: fixed;
                                    left: 0;
                                    top: 0;
                                    width: 60%;
                                    height: 100%;
                                    z-index: -1;
                                    background-image: url("{{ asset("images/gedung-sekolah.jpg") }}");
                                    background-size: cover;
                                    background-position: center;
                                    filter: brightness(0.85);
                                }

                                /* BAGIAN KANAN: AREA LOGIN */
                                .fi-simple-layout {
                                    position: fixed;
                                    right: 0;
                                    top: 0;
                                    width: 40%;
                                    height: 100vh;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    background: rgba(255, 255, 255, 0.96);
                                    backdrop-filter: blur(15px);
                                    border-left: 1px solid rgba(0,0,0,0.05);
                                }

                                .fi-simple-main {
                                    background: transparent !important;
                                    box-shadow: none !important;
                                    border: none !important;
                                    width: 100%;
                                    max-width: 420px !important;
                                    padding: 0 2rem !important;
                                    animation: slideUpFade 0.8s cubic-bezier(0.16, 1, 0.3, 1);
                                }
                                
                                .fi-simple-header {
                                    text-align: center;
                                    margin-bottom: 2.5rem;
                                }
                                .fi-logo {
                                    height: 5rem !important;
                                }
                            }

                            /* === PERBAIKAN DARK MODE & DOUBLE BORDER === */
                            
                            /* 1. Paksa Teks Judul Hitam */
                            .fi-simple-main h1, 
                            .fi-simple-main h2, 
                            .fi-simple-main span,
                            .fi-simple-header-heading {
                                color: #111827 !important;
                            }

                            /* 2. Styling Input (HAPUS BORDER MANUAL) */
                            .fi-input {
                                background-color: #f8fafc !important; 
                                /* border: ...  <-- INI SAYA HAPUS AGAR TIDAK DOUBLE LINE */
                                padding-inline: 1rem !important; /* Tambah padding dalam */
                                color: #1f2937 !important; /* Teks input hitam */
                            }

                            /* 3. Label Input */
                            label, .fi-fo-field-wrp-label span {
                                font-weight: 500 !important;
                                color: #475569 !important;
                                font-size: 0.9rem !important;
                            }

                            /* 4. Link Lupa Password */
                            .fi-simple-main a {
                                color: #d97706 !important;
                            }

                            /* === TOMBOL LOGIN === */
                            .fi-btn-primary {
                                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
                                border: none !important;
                                border-radius: 0.75rem !important;
                                padding-block: 0.75rem !important;
                                font-weight: 600 !important;
                                letter-spacing: 0.025em !important;
                                box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.3), 0 2px 4px -1px rgba(217, 119, 6, 0.1) !important;
                                transition: all 0.3s ease !important;
                                color: #ffffff !important;
                            }
                            .fi-btn-primary:hover {
                                transform: translateY(-2px);
                                box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.4), 0 4px 6px -2px rgba(217, 119, 6, 0.2) !important;
                                filter: brightness(1.1);
                            }
                        </style>
                    ') 
                    : ''
            )

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['id', 'en']),
            );
    }
}