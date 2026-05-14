<?php

namespace App\Livewire\Frontend;

use App\Models\KategoriKerusakan;
use App\Models\PermintaanMaintenance;
use App\Models\Ruangan;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPermintaanMaintenance extends Component
{
    use WithFileUploads;

    public string $nama_pelapor = '';
    public ?string $email_pelapor = null;
    public string $no_telepon_pelapor = '';

    public ?int $ruangan_id = null;
    public ?int $kategori_kerusakan_id = null;

    public string $judul = '';
    public string $deskripsi = '';
    public string $prioritas = 'sedang';

    public $foto_kerusakan;

    public ?string $kode_berhasil = null;

    public function submit(): void
    {
        $data = $this->validate([
            'nama_pelapor' => ['required', 'string', 'max:255'],
            'email_pelapor' => ['nullable', 'email', 'max:255'],
            'no_telepon_pelapor' => ['required', 'string', 'max:30'],

            'ruangan_id' => ['required', 'exists:ruangans,id'],
            'kategori_kerusakan_id' => ['required', 'exists:kategori_kerusakans,id'],

            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'prioritas' => ['required', 'in:rendah,sedang,tinggi,darurat'],

            'foto_kerusakan' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($this->foto_kerusakan) {
            $data['foto_kerusakan'] = $this->foto_kerusakan->store('foto-kerusakan', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['status'] = 'diajukan';
        $data['tanggal_laporan'] = now();

        $permintaan = PermintaanMaintenance::create($data);

        $this->kode_berhasil = $permintaan->kode_permintaan;

        $this->reset([
            'nama_pelapor',
            'email_pelapor',
            'no_telepon_pelapor',
            'ruangan_id',
            'kategori_kerusakan_id',
            'judul',
            'deskripsi',
            'foto_kerusakan',
        ]);

        $this->prioritas = 'sedang';
    }

    public function render()
    {
        return view('livewire.frontend.form-permintaan-maintenance', [
            'ruangans' => Ruangan::query()
                ->with('gedung')
                ->orderBy('nama_ruangan')
                ->get(),

            'kategoriKerusakans' => KategoriKerusakan::query()
                ->orderBy('nama_kategori')
                ->get(),
        ]);
    }
}