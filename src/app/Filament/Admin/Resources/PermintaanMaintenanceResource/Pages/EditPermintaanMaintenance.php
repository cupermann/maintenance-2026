<?php

namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Pages;

use App\Filament\Admin\Resources\PermintaanMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermintaanMaintenance extends EditRecord
{
    protected static string $resource = PermintaanMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
