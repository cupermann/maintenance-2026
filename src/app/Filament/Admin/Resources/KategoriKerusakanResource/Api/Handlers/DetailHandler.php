<?php

namespace App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Admin\Resources\KategoriKerusakanResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Transformers\KategoriKerusakanTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KategoriKerusakanResource::class;


    /**
     * Show KategoriKerusakan
     *
     * @param Request $request
     * @return KategoriKerusakanTransformer
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

        return new KategoriKerusakanTransformer($query);
    }
}
