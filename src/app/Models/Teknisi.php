<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_teknisi',
        'nama_teknisi',
        'no_telepon',
        'keahlian',
        'status',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penugasanTeknisis()
    {
        return $this->hasMany(PenugasanTeknisi::class, 'teknisi_id');
    }

    public function progresPerbaikans()
    {
        return $this->hasMany(ProgresPerbaikan::class, 'teknisi_id');
    }
}