<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hari extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'hari';
    protected $fillable =
    [
        'nama',
    ];
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'hari_id');
    }
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'hari_id');
    }
    public function contraint()
    {
        return $this->hasMany(Contraint::class, 'hari_id');
    }
}
