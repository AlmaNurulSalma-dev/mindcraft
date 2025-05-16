<?php

namespace App\Filament\Mentee\Resources;

use App\Filament\Mentee\Resources\EssaySubmissionResource\Pages;
use App\Models\EssaySubmission;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EssaySubmissionResource extends Resource
{
    protected static ?string $model = EssaySubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'My Assignments';
    protected static ?string $modelLabel = 'Assignment';
    protected static ?string $pluralModelLabel = 'Assignments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEssaySubmissions::route('/'),
            'create' => Pages\CreateEssaySubmission::route('/create'),
            'edit' => Pages\EditEssaySubmission::route('/{record}/edit'),
        ];
    }
}
