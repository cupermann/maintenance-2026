<?php

namespace App\Filament\Admin\Resources\ProgresPerbaikanResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgresPerbaikanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'permintaan_maintenance_id' => 'required',
			'teknisi_id' => 'required',
			'status_progres' => 'required',
			'deskripsi_progres' => 'required|string',
			'foto_progres' => 'required',
			'tanggal_progres' => 'required'
		];
    }
}
