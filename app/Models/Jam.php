<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\Contraint;
use App\Models\Reservasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jam extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'jam';
    protected $fillable =
    [
        'range_jam',
        'awal',
        'akhir'
    ];
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'jam_id');
    }
    public function Reservasi()
    {
        return $this->hasMany(Reservasi::class, 'jam_id');
    }
    public function contraint()
    {
        return $this->hasMany(Contraint::class, 'jam_id');
    }
}
