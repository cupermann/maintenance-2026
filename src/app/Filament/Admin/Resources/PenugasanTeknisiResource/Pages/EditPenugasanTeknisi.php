<?php

namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Pages;

use App\Filament\Admin\Resources\PenugasanTeknisiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenugasanTeknisi extends EditRecord
{
    protected static string $resource = PenugasanTeknisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
