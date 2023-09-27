<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'matakuliah';
    protected $fillable =
    [
        'nama',
        'kode_matkul',
        'semester',
        'sks',
        'status',
    ];
}
