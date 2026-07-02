<?php
namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PenugasanTeknisiResource;
use App\Filament\Admin\Resources\PenugasanTeknisiResource\Api\Requests\CreatePenugasanTeknisiRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PenugasanTeknisiResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create PenugasanTeknisi
     *
     * @param CreatePenugasanTeknisiRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePenugasanTeknisiRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}