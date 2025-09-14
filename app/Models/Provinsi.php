<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'provinsi';

    // Menentukan primary key
    protected $primaryKey = 'id';

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = ['id', 'namaprovinsi'];

    // Menentukan relasi dengan Kabupaten
    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'idprovinsi', 'id');
    }
}
