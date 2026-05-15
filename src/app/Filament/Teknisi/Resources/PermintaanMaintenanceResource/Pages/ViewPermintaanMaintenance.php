<?php

namespace App\Filament\Teknisi\Resources\PermintaanMaintenanceResource\Pages;

use App\Filament\Teknisi\Resources\PermintaanMaintenanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPermintaanMaintenance extends ViewRecord
{
    protected static string $resource = PermintaanMaintenanceResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}