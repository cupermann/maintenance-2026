<?php
namespace App\Filament\Admin\Resources\TeknisiResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Teknisi;

/**
 * @property Teknisi $resource
 */
class TeknisiTransformer extends JsonResource
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
