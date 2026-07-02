<?php
namespace App\Filament\Admin\Resources\RuanganResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\RuanganResource;
use App\Filament\Admin\Resources\RuanganResource\Api\Requests\CreateRuanganRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = RuanganResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Ruangan
     *
     * @param CreateRuanganRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateRuanganRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}