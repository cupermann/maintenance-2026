<?php
namespace App\Filament\Admin\Resources\KategoriKerusakanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\KategoriKerusakan;

/**
 * @property KategoriKerusakan $resource
 */
class KategoriKerusakanTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
