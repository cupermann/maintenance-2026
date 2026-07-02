<?php
namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ProgresPerbaikan;

/**
 * @property ProgresPerbaikan $resource
 */
class ProgresPerbaikanTransformer extends JsonResource
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
