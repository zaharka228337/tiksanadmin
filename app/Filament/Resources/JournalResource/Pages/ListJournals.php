<?php

namespace App\Filament\Resources\JournalResource\Pages;

use App\Filament\Resources\JournalResource;
use App\Models\Journal;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListJournals extends ListRecords
{
    protected static string $resource = JournalResource::class;

    public function getTabs():array{
        return [
            'Все' => Tab::make(),
            'За месяц' => Tab::make()
                ->badge(Journal::query()->where('created_at', '>=', now()->subMonth())->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at', '>=', now()->subMonth())),
            'За неделю' => Tab::make()
                ->badge(Journal::query()->where('created_at', '>=', now()->subWeek())->count())
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
