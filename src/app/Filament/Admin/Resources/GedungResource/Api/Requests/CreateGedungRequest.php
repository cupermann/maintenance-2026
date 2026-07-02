<?php

namespace App\Filament\Admin\Resources\GedungResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateGedungRequest extends FormRequest
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
			'nama_gedung' => 'required',
			'kode_gedung' => 'required',
			'alamat' => 'required|string',
			'keterangan' => 'required|string'
		];
    }
}
