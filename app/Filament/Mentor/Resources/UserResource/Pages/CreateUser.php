<?php

namespace App\Filament\Mentor\Resources\UserResource\Pages;

use App\Filament\Mentor\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
