<?php

namespace App\Filament\Resources\UnitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Lesson;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Str;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Pelajaran')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                    
                Select::make('content_type')
                    ->label('Tipe Konten')
                    ->options([
                        'text' => 'Teks',
                        'video' => 'Video',
                        'quiz' => 'Kuis',
                        'assignment' => 'Tugas',
                    ])
                    ->default('text')
                    ->required(),
                    
                TextInput::make('sequence')
                    ->label('Urutan')
                    ->numeric()
                    ->default(fn () => Lesson::where('unit_id', $this->ownerRecord->id)->count() + 1)
                    ->required(),
                    
                TextInput::make('video_url')
                    ->label('URL Video')
                    ->url()
                    ->helperText('Masukkan URL video YouTube, Vimeo, dll.')
                    ->visible(fn (Forms\Get $get) => $get('content_type') === 'video'),
                    
                RichEditor::make('content')
                    ->label('Isi Pelajaran')
                    ->required()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'bulletList',
                        'orderedList',
                        'link',
                        'image',
                    ])
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsDirectory('attachments/lessons')
                    ->fileAttachmentsVisibility('public'),
                    
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->unique(Lesson::class, 'slug', ignoreRecord: true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('sequence')
                    ->label('Urutan')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Pelajaran')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\BadgeColumn::make('content_type')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'text',
                        'success' => 'video',
                        'warning' => 'quiz',
                        'danger' => 'assignment',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'text' => 'Teks',
                        'video' => 'Video',
                        'quiz' => 'Kuis',
                        'assignment' => 'Tugas',
                        default => $state,
                    }),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('content_type')
                    ->label('Tipe')
                    ->options([
                        'text' => 'Teks',
                        'video' => 'Video',
                        'quiz' => 'Kuis',
                        'assignment' => 'Tugas',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['unit_id'] = $this->ownerRecord->id;
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sequence');
    }
}