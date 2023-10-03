<?php

namespace App\Filament\Resources\ReportageResource\Pages;

use App\Filament\Resources\ReportageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReportage extends CreateRecord
{
    protected static string $resource = ReportageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Репортаж создан';
    }
}
