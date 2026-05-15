<?php

namespace App\Livewire\Frontend;

use App\Models\PermintaanMaintenance;
use Illuminate\Support\Collection;
use Livewire\Component;

class RiwayatLaporan extends Component
{
    public string $keyword = '';

    public bool $sudahDicari = false;

    public function cari(): void
    {
        $this->validate([
            'keyword' => ['required', 'string', 'min:4'],
        ], [
            'keyword.required' => 'Masukkan kode permintaan, nomor telepon, atau email terlebih dahulu.',
            'keyword.min' => 'Masukkan minimal 4 karakter.',
        ]);

        $this->sudahDicari = true;
    }

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
                'progresPerbaikans.teknisi',
            ])
            ->where(function ($query) use ($keyword) {
                $query->where('kode_permintaan', $keyword)
                    ->orWhere('no_telepon_pelapor', $keyword)
                    ->orWhere('email_pelapor', $keyword);
            })
            ->latest()
            ->get();
    }

    public function getStatusLabel(string $status): string
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

    public function getStatusClass(string $status): string
    {
        return match ($status) {
            'diajukan' => 'status-blue',
            'diverifikasi' => 'status-cyan',
            'ditolak' => 'status-red',
            'ditugaskan' => 'status-purple',
            'diproses' => 'status-yellow',
            'selesai' => 'status-green',
            default => 'status-gray',
        };
    }

    public function render()
    {
        return view('livewire.frontend.riwayat-laporan', [
            'laporans' => $this->laporans,
        ]);
    }
}