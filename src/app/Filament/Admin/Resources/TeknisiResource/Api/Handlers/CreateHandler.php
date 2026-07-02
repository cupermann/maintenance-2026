<?php
namespace App\Filament\Admin\Resources\TeknisiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\TeknisiResource;
use App\Filament\Admin\Resources\TeknisiResource\Api\Requests\CreateTeknisiRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = TeknisiResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Teknisi
     *
     * @param CreateTeknisiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateTeknisiRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}