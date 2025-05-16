<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse as RegistrationResponseContract;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use App\Http\Responses\Auth\LoginResponse;
use App\Http\Responses\Auth\RegistrationResponse;
use App\Http\Responses\Auth\LogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind custom login response
        $this->app->bind(LoginResponseContract::class, LoginResponse::class);
        
        // Bind custom registration response
        $this->app->bind(RegistrationResponseContract::class, RegistrationResponse::class);
        
        // Bind custom logout response
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    public function boot(): void
    {
        //
    }
}