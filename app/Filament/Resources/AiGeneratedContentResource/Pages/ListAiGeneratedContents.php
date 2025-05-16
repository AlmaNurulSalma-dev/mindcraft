<?php

namespace App\Filament\Resources\AiGeneratedContentResource\Pages;

use App\Filament\Resources\AiGeneratedContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAiGeneratedContents extends ListRecords
{
    protected static string $resource = AiGeneratedContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
