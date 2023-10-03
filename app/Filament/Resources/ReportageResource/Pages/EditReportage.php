<?php

namespace App\Filament\Resources\ReportageResource\Pages;

use App\Filament\Resources\ReportageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReportage extends EditRecord
{
    protected static string $resource = ReportageResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Репортаж обновлен';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
