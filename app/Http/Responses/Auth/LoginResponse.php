<?php

namespace App\Http\Responses\Auth;

use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect('/login');
        }
        
        return redirect(match($user->role) {
            'admin' => '/admin',
            'mentor' => '/mentor',
            'mentee' => '/mentee',
            default => '/',
        });
    }
}