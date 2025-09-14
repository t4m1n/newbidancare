<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKategori extends Model
{
    use HasFactory;

    protected $table = 'layanan_kategori';

    public $incrementing = false; // Non-incrementing (karena UUID)
    protected $keyType = 'string'; // UUID bertipe string

    protected $fillable = [
        'id',
        'statusenabled',
        'namalayanankategori'
    ];

    public function layanans()
    {
        return $this->hasMany(Layanan::class, 'idlayanankategori', 'id');
    }
}
