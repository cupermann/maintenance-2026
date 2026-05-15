<?php

namespace App\Filament\Teknisi\Resources\PenugasanTeknisiResource\Pages;

use App\Filament\Teknisi\Resources\PenugasanTeknisiResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPenugasanTeknisi extends ViewRecord
{
    protected static string $resource = PenugasanTeknisiResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}