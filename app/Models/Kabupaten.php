<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'kabupaten';

    // Menentukan primary key
    protected $primaryKey = 'id';

    // Menentukan kolom yang dapat diisi (fillable)
    protected $fillable = ['id', 'idprovinsi', 'namakabupaten'];

    // Menentukan relasi dengan Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'idprovinsi', 'id');
    }
}
