<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanMaintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_permintaan',
        'user_id',
        'nama_pelapor',
        'email_pelapor',
        'no_telepon_pelapor',
        'ruangan_id',
        'kategori_kerusakan_id',
        'judul',
        'deskripsi',
        'foto_kerusakan',
        'prioritas',
        'status',
        'catatan_admin',
        'tanggal_laporan',
        'tanggal_verifikasi',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_laporan' => 'datetime',
        'tanggal_verifikasi' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (PermintaanMaintenance $permintaan) {
            if (empty($permintaan->kode_permintaan)) {
                $permintaan->kode_permintaan = 'PM-' . now()->format('YmdHis') . '-' . random_int(100, 999);
            }

            if (empty($permintaan->tanggal_laporan)) {
                $permintaan->tanggal_laporan = now();
            }

            if (empty($permintaan->status)) {
                $permintaan->status = 'diajukan';
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }

    public function kategoriKerusakan()
    {
        return $this->belongsTo(KategoriKerusakan::class, 'kategori_kerusakan_id');
    }

    public function penugasanTeknisis()
    {
        return $this->hasMany(PenugasanTeknisi::class, 'permintaan_maintenance_id');
    }

    public function penugasanTeknisi()
    {
        return $this->hasOne(PenugasanTeknisi::class, 'permintaan_maintenance_id');
    }

    public function progresPerbaikans()
    {
        return $this->hasMany(ProgresPerbaikan::class, 'permintaan_maintenance_id');
    }
}