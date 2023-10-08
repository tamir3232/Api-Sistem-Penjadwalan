<?php

namespace App\Models;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\pengampu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contraint extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table ='contraint';
    protected $fillable =
    [

        'pengampu_id',
        'hari_id',
        'jam_id',

    ];
    public function pengampu()
    {
        return $this->belongsTo(pengampu::class, 'pengampu_id');
    }
    public function hari()
    {
        return $this->hasMany(Hari::class, 'hari_id');
    }
    public function jam()
    {
        return $this->hasMany(Jam::class, 'jam_id');
    }

}
