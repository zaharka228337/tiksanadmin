<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SocialNetworkResource\Pages;
use App\Filament\Resources\SocialNetworkResource\RelationManagers;
use App\Models\SocialNetwork;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SocialNetworkResource extends Resource
{
    protected static ?string $model = SocialNetwork::class;

    protected static ?string $modelLabel = 'Социальные сети';
    protected static ?string $pluralModelLabel = 'Социальные сети';
//    protected static ?string $navigationGroup = 'Структура';

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Fieldset::make()
                            ->columns(3)
                            ->schema([
                                Textinput::make('vk')
                                    ->label('Вконтакте'),
                                Textinput::make('telegram')
                                    ->label('Телеграм'),
                                Textinput::make('youtube')
                                    ->label('Youtube'),
                                Textinput::make('dzen')
                                    ->label('Дзен'),
                                Textinput::make('vcru')
                                    ->label('VC.ru'),
                                Textinput::make('instagram')
                                    ->label('Instagram'),
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('vk')
                    ->label('Вконтакте'),
                TextColumn::make('telegram')
                    ->label('Телеграм'),
                TextColumn::make('youtube')
                    ->label('YouTube'),
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
            'index' => Pages\ListSocialNetworks::route('/'),
            'create' => Pages\CreateSocialNetwork::route('/create'),
            'edit' => Pages\EditSocialNetwork::route('/{record}/edit'),
        ];
    }
}
