<?php

namespace App\Filament\Resources\PhotoResource\Pages;

use App\Filament\Resources\PhotoResource;
use App\Models\Photo;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListPhotos extends ListRecords
{
    protected static string $resource = PhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs():array{
        return [
            'Все' => Tab::make(),
            'За месяц' => Tab::make()
                ->badge(Photo::query()->where('created_at', '>=', now()->subMonth())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth())),
            'За неделю' => Tab::make()
                ->badge(Photo::query()->where('created_at', '>=', now()->subWeek())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek())),
        ];
    }
}
