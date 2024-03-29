<?php

namespace App\Models;

use App\Models\Jam;
use App\Models\Hari;
use App\Models\Dosen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contraint extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'contraint';
    protected $fillable =
    [

        'dosen_id',
        'hari_id',
        'jam_id',

    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
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
