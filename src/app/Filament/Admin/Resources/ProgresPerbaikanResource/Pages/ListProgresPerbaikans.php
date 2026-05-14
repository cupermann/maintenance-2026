<?php

namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Pages;

use App\Filament\Admin\Resources\ProgresPerbaikanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProgresPerbaikans extends ListRecords
{
    protected static string $resource = ProgresPerbaikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
