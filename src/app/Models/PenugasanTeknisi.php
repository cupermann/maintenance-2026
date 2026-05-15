<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenugasanTeknisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'permintaan_maintenance_id',
        'teknisi_id',
        'admin_id',
        'tanggal_penugasan',
        'catatan_penugasan',
    ];

    protected $casts = [
        'tanggal_penugasan' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (PenugasanTeknisi $penugasan) {
            if (empty($penugasan->tanggal_penugasan)) {
                $penugasan->tanggal_penugasan = now();
            }
        });

        static::created(function (PenugasanTeknisi $penugasan) {
            $penugasan->permintaanMaintenance()->update([
                'status' => 'ditugaskan',
            ]);
        });
    }

     public function permintaanMaintenance()
    {
        return $this->belongsTo(PermintaanMaintenance::class, 'permintaan_maintenance_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(Teknisi::class, 'teknisi_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function progresPerbaikans()
    {
        return $this->hasMany(
            ProgresPerbaikan::class,
            'permintaan_maintenance_id',
            'permintaan_maintenance_id'
        );
    }
}