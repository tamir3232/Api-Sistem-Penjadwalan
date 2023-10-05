<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory,HasUuids;

    protected $table ='reservasi';
    protected $fillable =
    [
        'hari_id',
        'jam_id',
        'ruangan_id',
        'pengampu_id',
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
        return $this->hasMany(pengampu::class, 'pengampu_id');
    }
   
}
