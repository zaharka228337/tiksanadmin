<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Models\History;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
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

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $modelLabel = 'Историю компании';
    protected static ?string $pluralModelLabel = 'История компании';
//    protected static ?string $navigationGroup = 'Главное';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Настройки')
                    ->schema([
                        FieldSet::make()
                            ->columns(3)
                            ->schema([
                                Checkbox::make('active')
                                    ->label('Активен?')
                            ]),
                        FieldSet::make()
                            ->columns(3)
                            ->schema([
                                TextInput::make('sorting')
                                    ->label('Сортировка')
                                    ->rules('integer'),
                            ])
                    ]),
                Section::make('Основное')
                    ->schema([
                        FieldSet::make()
                            ->columns(1)
                            ->schema([
                                TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(255),
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
                ToggleColumn::make('active')
                    ->sortable()
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
            'index' => Pages\ListHistories::route('/'),
            'create' => Pages\CreateHistory::route('/create'),
            'edit' => Pages\EditHistory::route('/{record}/edit'),
        ];
    }
}
