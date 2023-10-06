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
    use HasFactory,HasUuids;
    protected $table ='jam';
    protected $fillable =
    [
    'range_jam',
    'awal',
    'akhir'
    ];
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class,'jadwal_id');
    }
    public function jam()
    {
        return $this->belongsTo(Reservasi::class,'reservasi_id');
    }
    public function contraint()
    {
        return $this->belongsTo(Contraint::class,'contraint_id');
    }

}
