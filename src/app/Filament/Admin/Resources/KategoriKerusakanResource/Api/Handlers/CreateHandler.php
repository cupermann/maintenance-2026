<?php
namespace App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\KategoriKerusakanResource;
use App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Requests\CreateKategoriKerusakanRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = KategoriKerusakanResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create KategoriKerusakan
     *
     * @param CreateKategoriKerusakanRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateKategoriKerusakanRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}