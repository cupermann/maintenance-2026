<?php
namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\ProgresPerbaikanResource;
use App\Filament\Admin\Resources\ProgresPerbaikanResource\Api\Requests\CreateProgresPerbaikanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = ProgresPerbaikanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create ProgresPerbaikan
     *
     * @param CreateProgresPerbaikanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateProgresPerbaikanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}