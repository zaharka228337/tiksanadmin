<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RadioResource\Pages;
use App\Models\Radio;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class RadioResource extends Resource
{
    protected static ?string $model = Radio::class;

    protected static ?string $modelLabel = 'Радио-эфир';
    protected static ?string $pluralModelLabel = 'Радио-эфиры';
    protected static ?string $navigationGroup = 'Пресс-центр';

    protected static ?string $navigationIcon = 'heroicon-o-radio';

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
                            ->schema([
                                TextInput::make('title')
                                    ->label('Заголовок')
                                    ->required()
                                    ->maxLength(80),
                                DatePicker::make('date_publish')
                                    ->afterOrEqual('today')
                                    ->label('Дата публикации')
                                    ->required(),
                            ])
                    ]),
                Section::make('Медиа')
                    ->schema([
                        FieldSet::make()
                            ->schema([
                                TextInput::make('audio')
                                    ->label('Аудио')
                                    ->required(),
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
            'index' => Pages\ListRadios::route('/'),
            'create' => Pages\CreateRadio::route('/create'),
            'edit' => Pages\EditRadio::route('/{record}/edit'),
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
