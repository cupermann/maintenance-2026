<?php
namespace App\Filament\Admin\Resources\GedungResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\GedungResource;
use App\Filament\Admin\Resources\GedungResource\Api\Requests\UpdateGedungRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = GedungResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Gedung
     *
     * @param UpdateGedungRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateGedungRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}