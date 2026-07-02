<?php
namespace App\Filament\Admin\Resources\GedungResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Gedung;

/**
 * @property Gedung $resource
 */
class GedungTransformer extends JsonResource
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
