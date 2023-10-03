<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory,HasUuids;

    protected $table ='jadwal';
    protected $fillable =
    [
        'hari_id',
        'jam_id',
        'ruangan_id',
        'pengampu_id',
        'reservasi_id',
    ];
    public function hari()
    {
        return $this->hasmany(Hari::class, 'hari_id');
    }
    public function jam()
    {
        return $this->hasmany(Jam::class, 'jam_id');
    }
    public function ruangan()
    {
        return $this->hasmany(Ruangan::class, 'ruangan_id');
    }
    public function pengampu()
    {
        return $this->hasmany(pengampu::class, 'jam_id');
    }
    public function reservasi()
    {
        return $this->hasmany(Reservasi::class, 'reservasi_id');
    }

}
