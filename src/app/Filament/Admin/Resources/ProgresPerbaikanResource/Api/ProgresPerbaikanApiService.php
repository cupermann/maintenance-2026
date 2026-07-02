<?php
namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\ProgresPerbaikanResource;
use Illuminate\Routing\Router;


class ProgresPerbaikanApiService extends ApiService
{
    protected static string | null $resource = ProgresPerbaikanResource::class;

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
