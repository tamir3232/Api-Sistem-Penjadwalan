<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'dosens';
    protected $fillable = [
        'name',
       'nip'
    ];



}
