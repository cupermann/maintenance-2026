<?php

namespace App\Filament\Admin\Resources\TeknisiResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Admin\Resources\TeknisiResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Admin\Resources\TeknisiResource\Api\Transformers\TeknisiTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = TeknisiResource::class;


    /**
     * Show Teknisi
     *
     * @param Request $request
     * @return TeknisiTransformer
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

        return new TeknisiTransformer($query);
    }
}
