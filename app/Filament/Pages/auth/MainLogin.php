<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;

class MainLogin extends BaseLogin
{
    protected ?string $selectedRole = null;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->autofocus(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(),
                Select::make('role')
                    ->label('Login as')
                    ->options([
                        'admin' => 'Administrator',
                        'mentor' => 'Mentor',
                        'mentee' => 'Student',
                    ])
                    ->required()
                    ->native(false),
            ])
            ->statePath('data');
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();
        $this->selectedRole = $data['role'] ?? null;

        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament::auth/login.failed'),
            ]);
        }

        $user = Auth::user();

        if ($user->role !== $this->selectedRole) {
            Auth::logout();
            throw ValidationException::withMessages([
                'data.role' => 'You do not have access to this role.',
            ]);
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }
}