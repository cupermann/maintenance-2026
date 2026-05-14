<?php

namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Pages;

use App\Filament\Admin\Resources\PenugasanTeknisiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPenugasanTeknisis extends ListRecords
{
    protected static string $resource = PenugasanTeknisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
