<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'gedung_id',
        'nama_ruangan',
        'kode_ruangan',
        'lantai',
        'keterangan',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function permintaanMaintenances()
    {
        return $this->hasMany(PermintaanMaintenance::class);
    }
}