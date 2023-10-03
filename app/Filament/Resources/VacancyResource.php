<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VacancyResource\Pages;
use App\Models\Vacancy;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class VacancyResource extends Resource
{
    protected static ?string $model = Vacancy::class;

    protected static ?string $modelLabel = 'Вакансию';
    protected static ?string $pluralModelLabel = 'Вакансии';
    protected static ?string $navigationGroup = 'Карьера';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Настройки')
                    ->schema([
                        FieldSet::make()
                            ->schema([
                                Checkbox::make('active')
                                    ->label('Активность'),
                            ]),
                        FieldSet::make()
                            ->schema([
                                TextInput::make('sorting')
                                    ->rules('integer')
                                    ->default(500)
                                    ->required()
                                    ->label('Сортировка'),
                            ])
                    ]),
                Section::make('Основное')
                    ->schema([
                        FieldSet::make()
                            ->columns(3)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(80),
                                DatePicker::make('date_publish')
                                    ->afterOrEqual('today')
                                    ->label('Дата публикации')
                                    ->required(),
                                TextInput::make('hh_link')
                                    ->label('HH.RU')
                            ]),
                        FieldSet::make()
                            ->columns(1)
                            ->schema([
                                RichEditor::make('detail_text')
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'undo',
                                    ])
                                    ->required()
                                    ->label('Детальный текст'),
                            ])
                    ]),
                Section::make('Медиа')
                    ->schema([
                        FieldSet::make()
                            ->columns(1)
                            ->schema([
                                FileUpload::make('detail_image')
                                    ->image()
                                    ->required()
                                    ->label('Детальная картинка')
                                    ->preserveFilenames()
                                    ->directory('form-attachments')
                                    ->visibility('private'),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sorting')
                    ->sortable()
                    ->label('Сортировка'),
                TextColumn::make('date_publish')
                    ->label('Дата публикации')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                ToggleColumn::make('active')
                    ->label('Состояние')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListVacancies::route('/'),
            'create' => Pages\CreateVacancy::route('/create'),
            'edit' => Pages\EditVacancy::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'green';
    }
}
