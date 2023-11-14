<?php

namespace App\Models;

use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Contraint;
use App\Models\Reservasi;
use App\Models\Matakuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pengampu extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pengampu';
    protected $fillable =
    [
        'id',
        'reservasi_id',
        'matakuliah_id',
        'kelas_id'
    ];


    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'kelas_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class,'reservasi_id');
    }
    // public function contraint()
    // {
    //     return $this->hasMany(Contraint::class, 'contraint_id');
    // }
}
