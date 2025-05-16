<?php

namespace App\Filament\Resources\AiGeneratedContentResource\Pages;

use App\Filament\Resources\AiGeneratedContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAiGeneratedContent extends EditRecord
{
    protected static string $resource = AiGeneratedContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
