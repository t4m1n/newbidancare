<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    /**
     * Tentukan nama tabel yang digunakan oleh model ini
     *
     * @var string
     */
    protected $table = 'pasiens';

    /**
     * Tentukan primary key tabel
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Tentukan apakah primary key adalah tipe string (char)
     *
     * @var bool
     */
    public $incrementing = false; // Karena id adalah string, bukan auto increment

    /**
     * Tentukan tipe data untuk kolom-kolom yang digunakan
     *
     * @var array
     */
    protected $casts = [
        'statusenabled' => 'boolean',
    ];

    /**
     * Tentukan kolom yang bisa diisi (Mass Assignment)
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'statusenabled',
        'user_id',
        'idprovinsi',
        'idkabupaten',
        'alamat',
        'nohp',
        'keterangan',
        'tgllhr',
        'longitude',
        'latitude',
        'approv',

    ];

    /**
     * Tentukan kolom yang tidak boleh diisi (protected)
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relasi ke tabel `users`, mengasumsikan ada relasi `User` di model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke tabel `provinsis`, mengasumsikan ada model `Provinsi`.
     */
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'idprovinsi');
    }

    /**
     * Relasi ke tabel `kabupatens`, mengasumsikan ada model `Kabupaten`.
     */
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'idkabupaten');
    }
}
