<?php

namespace App\Filament\Resources\RadioResource\Pages;

use App\Filament\Resources\RadioResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRadio extends CreateRecord
{
    protected static string $resource = RadioResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Радио-эфир создан';
    }
}
