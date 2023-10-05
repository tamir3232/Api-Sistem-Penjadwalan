<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengampu extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pengampu';
    protected $fillable =
    [
        'id',
        'dosen_id',
        'matakuliah_id',
        'kelas_id'
    ];


    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    public function matakuliah()
    {
        return $this->belongsTo(matakuliah::class, 'matakuliah_id');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'kelas_id');
    }
}
