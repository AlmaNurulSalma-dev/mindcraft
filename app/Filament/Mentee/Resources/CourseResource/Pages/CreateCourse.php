<?php

namespace App\Filament\Mentee\Resources\CourseResource\Pages;

use App\Filament\Mentee\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
