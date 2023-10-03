<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvertisementResource\Pages;
use App\Models\Advertisement;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static ?string $modelLabel = 'Рекламу';
    protected static ?string $pluralModelLabel = 'Реклама';
    protected static ?string $navigationGroup = 'Пресс-центр';
    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

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
                                    ->required(),
                            ])
                    ]),
                Section::make('Медиа')
                    ->schema([
                        FieldSet::make()
                            ->columns(1)
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->label('Изображение')
                                    ->required()
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
            'index' => Pages\ListAdvertisements::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
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
