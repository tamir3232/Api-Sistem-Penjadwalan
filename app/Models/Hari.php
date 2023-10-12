<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hari extends Model
{
    use HasFactory,HasUuids;
    protected $table='hari';
    protected $fillable =
    [
        'nama',
    ];
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class,'jadwal_id');
    }
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'reservasi_id');
    }
    public function contraint()
    {
        return $this->belongsTo(Contraint::class,'contraint_id');
    }

}
