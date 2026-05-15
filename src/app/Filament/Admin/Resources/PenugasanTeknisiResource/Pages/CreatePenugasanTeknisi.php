<?php

namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Pages;

use App\Filament\Admin\Resources\PenugasanTeknisiResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePenugasanTeknisi extends CreateRecord
{
    protected static string $resource = PenugasanTeknisiResource::class;

    protected function afterCreate(): void
    {
        $this->record->permintaanMaintenance?->update([
            'status' => 'ditugaskan',
        ]);
    }
}