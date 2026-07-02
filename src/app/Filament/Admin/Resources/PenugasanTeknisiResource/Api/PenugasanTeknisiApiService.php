<?php
namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\PenugasanTeknisiResource;
use Illuminate\Routing\Router;


class PenugasanTeknisiApiService extends ApiService
{
    protected static string | null $resource = PenugasanTeknisiResource::class;

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
