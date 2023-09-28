<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainSliderResource\Pages;
use App\Filament\Resources\MainSliderResource\RelationManagers;
use App\Models\MainSlider;
use Filament\Forms;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MainSliderResource extends Resource
{
    protected static ?string $model = MainSlider::class;

    protected static ?string $modelLabel = 'Главный слайдер';
    protected static ?string $pluralModelLabel = 'Слайдеры';
//    protected static ?string $navigationGroup = 'Главное';
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';

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
                                TextInput::make('organization')
                                    ->label('Название организации')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('link')
                                    ->label('Ссылка')
                                    ->required(),
                            ]),
                        Fieldset::make()
                            ->columns(1)
                            ->schema([
                                RichEditor::make('description')
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
                                    ->label('Описание'),
                            ]),
                    ]),
                Section::make('Медиа')
                    ->schema([
                        Fieldset::make()
                            ->columns(1)
                            ->schema([
                                FileUpload::make('detail_image')
                                    ->image()
                                    ->label('Детальная картинка')
                                    ->required()
                                    ->preserveFilenames()
                                    ->directory('form-attachments')
                                    ->visibility('private'),
                                FileUpload::make('logo')
                                    ->image()
                                    ->label('Логотип')
                                    ->required()
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
            'index' => Pages\ListMainSliders::route('/'),
            'create' => Pages\CreateMainSlider::route('/create'),
            'edit' => Pages\EditMainSlider::route('/{record}/edit'),
        ];
    }
}
