<?php
namespace App\Filament\Admin\Resources\PenugasanTeknisiResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PenugasanTeknisi;

/**
 * @property PenugasanTeknisi $resource
 */
class PenugasanTeknisiTransformer extends JsonResource
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
