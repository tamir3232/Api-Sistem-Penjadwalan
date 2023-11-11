<?php

namespace App\Models;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\Ruangan;
use App\Models\pengampu;
use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory, HasUuids;

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
        return $this->hasMany(pengampu::class, 'pengampu_id');
    }
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'reservasi_id');
    }

}
