<?php
namespace App\Filament\Admin\Resources\RuanganResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Ruangan;

/**
 * @property Ruangan $resource
 */
class RuanganTransformer extends JsonResource
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
