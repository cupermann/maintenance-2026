<?php
namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Requests\UpdatePermintaanMaintenanceRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = PermintaanMaintenanceResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update PermintaanMaintenance
     *
     * @param UpdatePermintaanMaintenanceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdatePermintaanMaintenanceRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}