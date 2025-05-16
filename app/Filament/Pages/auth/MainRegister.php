<?php

namespace App\Filament\Pages\Auth;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;

class MainRegister extends BaseRegister
{
    protected ?string $userRole = null;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Full name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->unique(User::class)
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->same('passwordConfirmation'),
                TextInput::make('passwordConfirmation')
                    ->label('Confirm password')
                    ->password()
                    ->required()
                    ->dehydrated(false),
                Select::make('role')
                    ->label('Register as')
                    ->options([
                        'mentor' => 'Mentor',
                        'mentee' => 'Student',
                    ])
                    ->default('mentee')
                    ->required(),
            ]);
    }

    public function register(): ?RegistrationResponse
    {
        $data = $this->form->getState();
        
        $this->userRole = $data['role'];

        $user = $this->getUserModel()::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        Auth::login($user);

        session()->regenerate();

        return app(RegistrationResponse::class);
    }

    public function getRedirectUrl(): string
    {
        return match($this->userRole ?? 'mentee') {
            'admin' => '/admin',
            'mentor' => '/mentor',
            'mentee' => '/mentee',
            default => '/',
        };
    }

    protected function getUserModel(): string
    {
        return User::class;
    }
}