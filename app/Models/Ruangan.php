<?php

namespace App\Models;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'ruangan';
    protected $fillable = [
        'nama',
    ];
    public function jadwal()
    {
        $this->hasMany(Jadwal::class, 'ruangan_id');
    }
    public function reservasi()
    {
        $this->hasMany(Reservasi::class, 'ruangan_id');
    }
}
