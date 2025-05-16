<?php

namespace App\Filament\Mentor\Resources;

use App\Filament\Mentor\Resources\MentorshipResource\Pages;
use App\Filament\Mentor\Resources\MentorshipResource\RelationManagers;
use App\Models\Mentorship;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class MentorshipResource extends Resource
{
    protected static ?string $model = Mentorship::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Mentorships';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Student')
                    ->relationship('user', 'name', fn (Builder $query) => $query->where('role', 'mentee'))
                    ->required(),
                Forms\Components\Select::make('course_id')
                    ->label('Course')
                    ->relationship('course', 'name')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student'),
                Tables\Columns\TextColumn::make('course.name')
                    ->label('Course'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'completed' => 'info',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Started')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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

    // Query untuk hanya menampilkan mentorship punyanya mentor ini
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('mentor_id', Auth::id());
    }
}
