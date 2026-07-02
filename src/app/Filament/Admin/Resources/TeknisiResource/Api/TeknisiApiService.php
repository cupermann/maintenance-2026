<?php
namespace App\Filament\Admin\Resources\TeknisiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\TeknisiResource;
use Illuminate\Routing\Router;


class TeknisiApiService extends ApiService
{
    protected static string | null $resource = TeknisiResource::class;

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
