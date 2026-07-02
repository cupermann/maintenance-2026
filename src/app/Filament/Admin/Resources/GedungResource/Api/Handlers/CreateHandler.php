<?php
namespace App\Filament\Admin\Resources\GedungResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\GedungResource;
use App\Filament\Admin\Resources\GedungResource\Api\Requests\CreateGedungRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = GedungResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Gedung
     *
     * @param CreateGedungRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateGedungRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}