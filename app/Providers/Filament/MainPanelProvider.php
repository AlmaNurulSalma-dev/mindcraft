<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\MainLogin;
use App\Filament\Pages\Auth\MainRegister;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;

class MainPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('main')
            ->path('app') // Path tanpa leading slash
            ->login(MainLogin::class)
            ->registration(MainRegister::class)
            ->brandName('MINDCRAFT-EXPO')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\Session\Middleware\AuthenticateSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
                \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
            ]);
    }
}