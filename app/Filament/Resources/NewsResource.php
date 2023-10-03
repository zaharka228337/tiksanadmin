<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
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

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $modelLabel = 'Новость';
    protected static ?string $pluralModelLabel = 'Новости';
    protected static ?string $navigationGroup = 'Пресс-центр';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Настройки')
                    ->schema([
                        Fieldset::make()
                            ->columns(3)
                            ->schema([
                                Checkbox::make('active')
                                    ->label('Активен?')
                            ]),
                        Fieldset::make()
                            ->columns(3)
                            ->schema([
                                TextInput::make('sorting')
                                    ->label('Сортировка')
                                    ->rules('integer'),
                                DatePicker::make('date_publish')
                                    ->afterOrEqual('today')
                                    ->label('Дата публикации')
                                    ->required(),
                            ]),
                    ]),
                Section::make('Основное')
                    ->schema([
                        Fieldset::make()
                            ->columns(3)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('youtube_video')
                                    ->label('Ссылка на YouTube')
                            ]),
                        Fieldset::make()
                            ->columns(1)
                            ->schema([
                                RichEditor::make('news_body')
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
                            ]),
                    ]),
                Section::make('Изображения')
                    ->schema([
                        FieldSet::make()
                            ->columns(1)
                            ->schema([
                                FileUpload::make('preview_image')
                                    ->image()
                                    ->label('Картинка для анонса')
                                    ->required()
                                    ->preserveFilenames()
                                    ->directory('form-attachments')
                                    ->visibility('private'),
                                FileUpload::make('detail_image')
                                    ->image()
                                    ->label('Детальная картинка')
                                    ->preserveFilenames()
                                    ->directory('form-attachments')
                                    ->visibility('private'),
                                FileUpload::make('images_gallery')
                                    ->image()
                                    ->label('Галерея')
                                    ->multiple()
                                    ->minFiles(2)
                                    ->maxFiles(10)
                                    ->preserveFilenames()
                                    ->directory('form-attachments')
                                    ->visibility('private'),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sorting')
                    ->sortable()
                    ->label('Сортировка'),
                TextColumn::make('title')
                    ->searchable()
                    ->label('Заголовок'),
                TextColumn::make('date_publish')
                    ->sortable()
                    ->label('Дата публикации'),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
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
