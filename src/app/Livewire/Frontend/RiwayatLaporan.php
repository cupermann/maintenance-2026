<?php

namespace App\Livewire\Frontend;

use App\Models\PermintaanMaintenance;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class RiwayatLaporan extends Component
{
    public string $keyword = '';

    public bool $sudahDicari = false;

    /**
     * Menjalankan pencarian laporan.
     */
    public function cari(): void
    {
        $this->keyword = trim($this->keyword);

        $this->validate([
            'keyword' => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
        ], [
            'keyword.required' => 'Masukkan kode permintaan, nomor telepon, atau email terlebih dahulu.',
            'keyword.min' => 'Masukkan minimal 4 karakter.',
            'keyword.max' => 'Kata pencarian terlalu panjang.',
        ]);

        $this->sudahDicari = true;
    }

    /**
     * Menyembunyikan hasil lama ketika kata pencarian diubah.
     */
    public function updatedKeyword(): void
    {
        $this->sudahDicari = false;

        $this->resetValidation('keyword');
    }

    /**
     * Mengambil laporan beserta detail penugasan dan progres teknisi.
     */
    public function getLaporansProperty(): Collection
    {
        if (! $this->sudahDicari) {
            return collect();
        }

        $keyword = trim($this->keyword);

        if ($keyword === '') {
            return collect();
        }

        return PermintaanMaintenance::query()
            ->with([
                'user',

                'ruangan.gedung',

                'kategoriKerusakan',

                'penugasanTeknisi.teknisi',

                'progresPerbaikans' => function ($query) {
                    $query
                        ->with('teknisi')
                        ->orderByDesc('tanggal_progres')
                        ->orderByDesc('id');
                },
            ])
            ->where(function ($query) use ($keyword) {
                $query
                    ->where('kode_permintaan', $keyword)
                    ->orWhere('no_telepon_pelapor', $keyword)
                    ->orWhere('email_pelapor', $keyword);
            })
            ->orderByDesc('tanggal_laporan')
            ->orderByDesc('id')
            ->get();
    }

    /**
     * Label status laporan.
     */
    public function getStatusLabel(?string $status): string
    {
        return match ($status) {
            'diajukan' => 'Diajukan',
            'diverifikasi' => 'Diverifikasi',
            'ditolak' => 'Ditolak',
            'ditugaskan' => 'Ditugaskan',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            default => 'Tidak diketahui',
        };
    }

    /**
     * Class warna status laporan.
     */
    public function getStatusClass(?string $status): string
    {
        return match ($status) {
            'diajukan' => 'status-diajukan',
            'diverifikasi' => 'status-diverifikasi',
            'ditolak' => 'status-ditolak',
            'ditugaskan' => 'status-ditugaskan',
            'diproses' => 'status-diproses',
            'selesai' => 'status-selesai',
            default => 'status-diajukan',
        };
    }

    /**
     * Label status progres teknisi.
     */
    public function getStatusProgresLabel(?string $status): string
    {
        return match ($status) {
            'mulai_dikerjakan' => 'Mulai Dikerjakan',
            'dikerjakan' => 'Sedang Dikerjakan',
            'selesai' => 'Selesai',
            default => 'Pembaruan Progres',
        };
    }

    public function render(): View
    {
        return view('livewire.frontend.riwayat-laporan', [
            'laporans' => $this->laporans,
        ]);
    }
}