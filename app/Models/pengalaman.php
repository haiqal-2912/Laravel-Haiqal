<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengalaman extends Model
{
    protected $table    = 'pengalaman';
    protected $fillable = ['judul', 'instansi', 'tahun_mulai', 'tahun_selesai', 'deskripsi'];
}
