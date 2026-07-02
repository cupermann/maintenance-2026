<?php
namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\PermintaanMaintenance;

/**
 * @property PermintaanMaintenance $resource
 */
class PermintaanMaintenanceTransformer extends JsonResource
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
