<?php
namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use App\Filament\Admin\Resources\PenugasanTeknisiResource;
use App\Filament\Admin\Resources\PenugasanTeknisiResource\Api\Transformers\PenugasanTeknisiTransformer;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = PenugasanTeknisiResource::class;


    /**
     * List of PenugasanTeknisi
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
        ->allowedFields($this->getAllowedFields() ?? [])
        ->allowedSorts($this->getAllowedSorts() ?? [])
        ->allowedFilters($this->getAllowedFilters() ?? [])
        ->allowedIncludes($this->getAllowedIncludes() ?? [])
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return PenugasanTeknisiTransformer::collection($query);
    }
}
