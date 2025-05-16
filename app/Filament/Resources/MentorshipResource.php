<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MentorshipResource\Pages;
use App\Filament\Resources\MentorshipResource\RelationManagers;
use App\Models\Mentorship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class MentorshipResource extends Resource
{
    protected static ?string $model = Mentorship::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('mentor_id')
                    ->label('Mentor')
                    ->relationship('mentor', 'name')
                    ->required(),
                Select::make('user_id')
                    ->label('Siswa')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('course_id')
                    ->label('Course')
                    ->relationship('course', 'name')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mentor.name')
                    ->label('Mentor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Siswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course.name')
                    ->label('Course')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
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
            'index' => Pages\ListMentorships::route('/'),
            'create' => Pages\CreateMentorship::route('/create'),
            'edit' => Pages\EditMentorship::route('/{record}/edit'),
        ];
    }
}