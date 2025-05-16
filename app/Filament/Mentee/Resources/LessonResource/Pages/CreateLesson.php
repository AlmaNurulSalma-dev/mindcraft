<?php

namespace App\Filament\Mentee\Resources\LessonResource\Pages;

use App\Filament\Mentee\Resources\LessonResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;
}
