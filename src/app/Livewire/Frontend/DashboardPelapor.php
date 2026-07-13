<?php

namespace App\Livewire\Frontend;

use App\Models\PermintaanMaintenance;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class DashboardPelapor extends Component
{
    public array $summary = [];

    public function mount(): void
    {
        $this->loadSummary();
    }

    public function refreshSummary(): void
    {
        $this->loadSummary();
    }

    private function loadSummary(): void
    {
        $this->summary = [
            'total' => PermintaanMaintenance::query()->count(),

            'diproses' => PermintaanMaintenance::query()
                ->whereIn('status', [
                    'diverifikasi',
                    'ditugaskan',
                    'diproses',
                ])
                ->count(),

            'selesai' => PermintaanMaintenance::query()
                ->where('status', 'selesai')
                ->count(),
        ];
    }

    public function render(): View
    {
        $email = (string) config('fixora.contact.email');

        $whatsappNumber = (string) config(
            'fixora.contact.whatsapp_number'
        );

        $emailSubject = rawurlencode('Bantuan Layanan Fixora');

        $emailBody = rawurlencode(
            "Halo Admin Fixora,\n\n"
            . "Saya membutuhkan bantuan terkait layanan pelaporan "
            . "fasilitas kampus.\n\n"
            . "Terima kasih."
        );

        $whatsappMessage = rawurlencode(
            'Halo Admin Fixora, saya membutuhkan bantuan terkait '
            . 'layanan pelaporan fasilitas kampus.'
        );

        return view('livewire.frontend.dashboard-pelapor', [
            'contactEmail' => $email,

            'whatsappDisplay' => config(
                'fixora.contact.whatsapp_display'
            ),

            'emailLink' => "mailto:{$email}"
                . "?subject={$emailSubject}"
                . "&body={$emailBody}",

            'whatsappLink' => "https://wa.me/{$whatsappNumber}"
                . "?text={$whatsappMessage}",
        ])->layout('components.layouts.pelapor', [
            'title' => 'Dashboard Pelapor | Fixora',
        ]);
    }
}