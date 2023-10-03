<?php

namespace App\Filament\Resources\SocialNetworkResource\Pages;

use App\Filament\Resources\SocialNetworkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSocialNetwork extends CreateRecord
{
    protected static string $resource = SocialNetworkResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Социальная сеть создана';
    }
}
