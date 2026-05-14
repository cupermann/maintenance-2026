<?php

namespace App\Livewire\Frontend;

use App\Models\PermintaanMaintenance;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardPelapor extends Component
{
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.frontend.dashboard-pelapor', [
            'permintaanMaintenances' => PermintaanMaintenance::query()
                ->where('user_id', auth()->id())
                ->latest()
                ->get(),
        ]);
    }
}