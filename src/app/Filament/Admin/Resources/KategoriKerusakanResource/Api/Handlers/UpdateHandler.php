<?php
namespace App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\KategoriKerusakanResource;
use App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Requests\UpdateKategoriKerusakanRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = KategoriKerusakanResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update KategoriKerusakan
     *
     * @param UpdateKategoriKerusakanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateKategoriKerusakanRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}