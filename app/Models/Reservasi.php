<?php

namespace App\Models;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservasi extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'reservasi';
    protected $fillable =
    [
        'hari_id',
        'jam_id',
        'ruangan_id',
        'pengampu_id',
        'reservasiby_id',
        'status',

    ];
    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id');
    }
    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
    public function pengampu()
    {
        return $this->belongsTo(pengampu::class, 'pengampu_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
    public function user()
    {
        return $this->belongsto(User::class, 'login');

    }
}
