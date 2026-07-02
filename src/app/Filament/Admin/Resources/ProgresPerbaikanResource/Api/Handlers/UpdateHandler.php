<?php
namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\ProgresPerbaikanResource;
use App\Filament\Admin\Resources\ProgresPerbaikanResource\Api\Requests\UpdateProgresPerbaikanRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = ProgresPerbaikanResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update ProgresPerbaikan
     *
     * @param UpdateProgresPerbaikanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateProgresPerbaikanRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}