<?php

namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Pages;

use App\Filament\Admin\Resources\ProgresPerbaikanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProgresPerbaikan extends EditRecord
{
    protected static string $resource = ProgresPerbaikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
