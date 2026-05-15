<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (! Auth::check()) {
        return view('auth.login');
    }

    $user = Auth::user();

    if (in_array($user->role, ['super_admin', 'admin'])) {
        return redirect('/admin');
    }

    if ($user->role === 'teknisi') {
        return redirect('/teknisi');
    }

    return redirect()->route('dashboard-pelapor');
})->name('home');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::view('/pelapor', 'public.dashboard-pelapor')
    ->name('pelapor.dashboard');

Route::view('/lapor-maintenance', 'public.lapor-maintenance')
    ->name('lapor-maintenance');

Route::view('/riwayat-laporan', 'public.riwayat-laporan')
    ->name('riwayat-laporan');

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');