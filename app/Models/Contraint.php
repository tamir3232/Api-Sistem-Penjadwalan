<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contraint extends Model
{
    use HasFactory, HasUuids;
    protected $table ='contraint';
    protected $fillable =
    [

        'pengampu_id',
        'hari_id',
        'jam_id',

    ];
    public function pengampu()
    {
        return $this->hasMany(pengampu::class, 'pengampu_id');
    }
    public function hari()
    {
        return $this->belongsTo(Hari::class, 'hari_id');
    }
    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id');
    }

}
