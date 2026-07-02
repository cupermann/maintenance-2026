<?php
namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource;
use Illuminate\Routing\Router;


class PermintaanMaintenanceApiService extends ApiService
{
    protected static string | null $resource = PermintaanMaintenanceResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
