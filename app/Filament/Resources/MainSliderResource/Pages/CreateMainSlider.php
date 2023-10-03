<?php

namespace App\Filament\Resources\MainSliderResource\Pages;

use App\Filament\Resources\MainSliderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMainSlider extends CreateRecord
{
    protected static string $resource = MainSliderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Главный слайдер создан';
    }
}
