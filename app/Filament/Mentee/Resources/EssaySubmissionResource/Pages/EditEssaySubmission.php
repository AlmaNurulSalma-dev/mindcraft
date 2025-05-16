<?php

namespace App\Filament\Mentee\Resources\EssaySubmissionResource\Pages;

use App\Filament\Mentee\Resources\EssaySubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEssaySubmission extends EditRecord
{
    protected static string $resource = EssaySubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
