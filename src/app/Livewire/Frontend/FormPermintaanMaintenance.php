<?php

namespace App\Livewire\Frontend;

use App\Models\Gedung;
use App\Models\KategoriKerusakan;
use App\Models\PermintaanMaintenance;
use App\Models\Ruangan;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormPermintaanMaintenance extends Component
{
    use WithFileUploads;

    public string $nama_pelapor = '';
    public ?string $email_pelapor = null;
    public string $no_telepon_pelapor = '';

    /**
     * gedung_id hanya digunakan untuk memfilter ruangan.
     * Nilainya tidak disimpan ke permintaan_maintenances.
     */
    public ?int $gedung_id = null;
    public ?int $ruangan_id = null;
    public ?int $kategori_kerusakan_id = null;

    public string $judul = '';
    public string $deskripsi = '';
    public string $prioritas = 'sedang';

    public $foto_kerusakan;

    public ?string $kode_berhasil = null;

    /**
     * Dijalankan otomatis ketika pilihan gedung berubah.
     */
    public function updatedGedungId(): void
    {
        $this->reset('ruangan_id');
        $this->resetValidation('ruangan_id');
    }

    public function submit(): void
    {
        $data = $this->validate([
            'nama_pelapor' => [
                'required',
                'string',
                'max:255',
            ],

            'email_pelapor' => [
                'nullable',
                'email',
                'max:255',
            ],

            'no_telepon_pelapor' => [
                'required',
                'String',
                'regex:/^[0-9]{5,15}$/',
            ],

            'gedung_id' => [
                'required',
                'exists:gedungs,id',
            ],

            'ruangan_id' => [
                'required',
                Rule::exists('ruangans', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'gedung_id',
                            $this->gedung_id
                        )
                    ),
            ],

            'kategori_kerusakan_id' => [
                'required',
                'exists:kategori_kerusakans,id',
            ],

            'judul' => [
                'required',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            'prioritas' => [
                'required',
                'in:rendah,sedang,tinggi,darurat',
            ],

            'foto_kerusakan' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'gedung_id.required' => 'Gedung wajib dipilih.',
            'gedung_id.exists' => 'Gedung yang dipilih tidak valid.',

            'no_telepon_pelapor.required' => 'Nomor telepon wajib diisi.',
            'no_telepon_pelapor.regex' => 'Nomor telepon hanya boleh berisi angka dan minimal 5 digit.',

            'ruangan_id.required' => 'Ruangan wajib dipilih.',
            'ruangan_id.exists' => 'Ruangan tidak sesuai dengan gedung yang dipilih.',
        ]);

        if ($this->foto_kerusakan) {
            $data['foto_kerusakan'] = $this->foto_kerusakan->store(
                'foto-kerusakan',
                'public'
            );
        }

        /*
         * gedung_id tidak perlu disimpan karena gedung sudah dapat
         * diketahui melalui relasi ruangan -> gedung.
         */
        unset($data['gedung_id']);

        /*
         * Karena halaman pelapor dapat digunakan tanpa login,
         * user_id akan bernilai null jika pengunjung belum login.
         */
        $data['user_id'] = auth()->id();
        $data['status'] = 'diajukan';
        $data['tanggal_laporan'] = now();

        $permintaan = PermintaanMaintenance::create($data);

        $this->kode_berhasil = $permintaan->kode_permintaan;

        $this->reset([
            'nama_pelapor',
            'email_pelapor',
            'no_telepon_pelapor',
            'gedung_id',
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
            'gedungs' => Gedung::query()
                ->orderBy('nama_gedung')
                ->get(),

            'ruangans' => Ruangan::query()
                ->with('gedung')
                ->when(
                    $this->gedung_id,
                    fn ($query) => $query->where(
                        'gedung_id',
                        $this->gedung_id
                    ),
                    fn ($query) => $query->whereRaw('1 = 0')
                )
                ->orderBy('nama_ruangan')
                ->get(),

            'kategoriKerusakans' => KategoriKerusakan::query()
                ->orderBy('nama_kategori')
                ->get(),
        ]);
    }
}