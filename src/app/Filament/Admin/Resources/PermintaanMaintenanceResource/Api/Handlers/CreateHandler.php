<?php
namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Requests\CreatePermintaanMaintenanceRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PermintaanMaintenanceResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create PermintaanMaintenance
     *
     * @param CreatePermintaanMaintenanceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreatePermintaanMaintenanceRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}