<?php
namespace App\Filament\Admin\Resources\RuanganResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\RuanganResource;
use Illuminate\Routing\Router;


class RuanganApiService extends ApiService
{
    protected static string | null $resource = RuanganResource::class;

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
