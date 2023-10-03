<?php

namespace App\Filament\Resources\MainSliderResource\Pages;

use App\Filament\Resources\MainSliderResource;
use App\Models\MainSlider;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListMainSliders extends ListRecords
{
    protected static string $resource = MainSliderResource::class;

    public function getTabs():array{
        return [
            'Все' => Tab::make(),
            'За месяц' => Tab::make()
                ->badge(MainSlider::query()->where('created_at', '>=', now()->subMonth())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth())),
            'За неделю' => Tab::make()
                ->badge(MainSlider::query()->where('created_at', '>=', now()->subWeek())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subWeek())),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
