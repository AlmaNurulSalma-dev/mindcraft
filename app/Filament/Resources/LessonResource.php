<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('unit_id')
                    ->label('Unit')
                    ->relationship('unit', 'name')  
                    ->required(),
                TextInput::make('title')
                    ->label('Judul Lesson')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                Select::make('content_type')
                    ->label('Tipe Konten')
                    ->options([
                        'text' => 'Text',
                        'video' => 'Video',
                        'pdf' => 'PDF',
                        'quiz' => 'Quiz',
                    ])
                    ->required(),
                Textarea::make('content')
                    ->label('Konten')
                    ->required()
                    ->rows(5),
                TextInput::make('video_url')
                    ->label('URL Video')
                    ->url()
                    ->maxLength(255),
                TextInput::make('sequence')
                    ->label('Urutan')
                    ->numeric()
                    ->required()
                    ->default(1),
                TextInput::make('slug')
                    ->label('Slug')
                    ->unique()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unit.name')
                    ->label('Unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content_type')
                    ->label('Tipe'),
                Tables\Columns\TextColumn::make('sequence')
                    ->label('Urutan')
                    ->numeric(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
}