<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanan';

    public $incrementing = false; // Non-incrementing (karena UUID)
    protected $keyType = 'string'; // UUID bertipe string

    protected $fillable = [
        'id',
        'statusenabled',
        'idlayanankategori',
        'namalayanan',
        'harga',
        'gambar',
        'keterangan',
        'idbidan'
    ];

    public function layanankategori()
    {
        return $this->belongsTo(LayananKategori::class, 'idlayanankategori', 'id');
    }
}
