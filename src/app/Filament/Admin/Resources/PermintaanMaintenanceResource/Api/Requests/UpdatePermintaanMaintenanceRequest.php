<?php

namespace App\Filament\Admin\Resources\PermintaanMaintenanceResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermintaanMaintenanceRequest extends FormRequest
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
			'kode_permintaan' => 'required',
			'user_id' => 'required',
			'nama_pelapor' => 'required',
			'email_pelapor' => 'required',
			'no_telepon_pelapor' => 'required',
			'ruangan_id' => 'required',
			'kategori_kerusakan_id' => 'required',
			'judul' => 'required',
			'deskripsi' => 'required|string',
			'foto_kerusakan' => 'required',
			'prioritas' => 'required',
			'status' => 'required',
			'catatan_admin' => 'required|string',
			'tanggal_laporan' => 'required',
			'tanggal_verifikasi' => 'required',
			'tanggal_selesai' => 'required'
		];
    }
}
