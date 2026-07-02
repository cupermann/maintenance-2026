<?php
namespace App\Filament\Admin\Resources\KategoriKerusakanResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\KategoriKerusakanResource;
use Illuminate\Routing\Router;


class KategoriKerusakanApiService extends ApiService
{
    protected static string | null $resource = KategoriKerusakanResource::class;

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
