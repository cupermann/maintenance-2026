<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   public function canAccessPanel(\Filament\Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->role === 'super_admin'
                || $this->role === 'admin'
                || $this->hasAnyRole(['super_admin', 'admin']);
        }

        if ($panel->getId() === 'teknisi') {
            return $this->role === 'teknisi'
                || $this->hasRole('teknisi');
        }

        return false;
    }   

    public function teknisi()
    {
        return $this->hasOne(Teknisi::class);
    }

    public function permintaanMaintenances()
    {
        return $this->hasMany(PermintaanMaintenance::class);
    }
}