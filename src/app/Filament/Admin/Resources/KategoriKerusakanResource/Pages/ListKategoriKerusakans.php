<?php

namespace App\Filament\Admin\Resources\KategoriKerusakanResource\Pages;

use App\Filament\Admin\Resources\KategoriKerusakanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriKerusakans extends ListRecords
{
    protected static string $resource = KategoriKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
