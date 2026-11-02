<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tes extends Model
{
    protected $table = 'tabel_tes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'alamat',
        'umur'
    ];
}
