<?php

namespace App\Models;

use App\Models\pengampu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'dosens';
    protected $fillable = [
        'name',
        'nip'
    ];

    public function pengampu()
    {
        return $this->hasMany(pengampu::class, 'dosen_id');
    }
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'reservasi_id');
    }
    public function contraint()
    {
        return $this->hasmany(Contraint::class, 'contraint_id');
    }
}
