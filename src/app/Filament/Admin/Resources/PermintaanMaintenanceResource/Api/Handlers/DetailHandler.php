<?php

namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Transformers\PermintaanMaintenanceTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = PermintaanMaintenanceResource::class;


    /**
     * Show PermintaanMaintenance
     *
     * @param Request $request
     * @return PermintaanMaintenanceTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new PermintaanMaintenanceTransformer($query);
    }
}
