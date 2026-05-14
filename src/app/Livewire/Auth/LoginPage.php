<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login()
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            $this->addError('email', 'Email atau password tidak sesuai.');

            return;
        }

        session()->regenerate();

        $user = Auth::user();

        if (in_array($user->role, ['super_admin', 'admin'])) {
            return redirect()->to('/admin');
        }

        if ($user->role === 'teknisi') {
            return redirect()->to('/teknisi');
        }

        return redirect()->route('dashboard-pelapor');
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}