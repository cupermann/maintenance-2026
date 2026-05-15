<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresPerbaikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'permintaan_maintenance_id',
        'teknisi_id',
        'status_progres',
        'deskripsi_progres',
        'foto_progres',
        'tanggal_progres',
    ];

    protected $casts = [
        'tanggal_progres' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (ProgresPerbaikan $progres) {
            if (empty($progres->tanggal_progres)) {
                $progres->tanggal_progres = now();
            }
        });

        static::created(function (ProgresPerbaikan $progres) {
            if ($progres->status_progres === 'selesai') {
                $progres->permintaanMaintenance()->update([
                    'status' => 'selesai',
                    'tanggal_selesai' => now(),
                ]);

                return;
            }

            $progres->permintaanMaintenance()->update([
                'status' => 'diproses',
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

    public function penugasanTeknisi()
    {
        return $this->belongsTo(
            PenugasanTeknisi::class,
            'permintaan_maintenance_id',
            'permintaan_maintenance_id'
        );
    }
}