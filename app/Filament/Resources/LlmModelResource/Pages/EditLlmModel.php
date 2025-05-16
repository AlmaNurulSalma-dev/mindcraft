<?php

namespace App\Filament\Resources\LlmModelResource\Pages;

use App\Filament\Resources\LlmModelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLlmModel extends EditRecord
{
    protected static string $resource = LlmModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
