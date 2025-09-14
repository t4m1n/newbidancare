<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail_t';
    protected $primaryKey = 'id';
    public $incrementing = false; // Karena id adalah string, bukan auto increment

    protected $casts = [
        'statusenabled' => 'boolean',
    ];

    protected $fillable = [
        'id',
        'statusenabled',
        'order_id',
        'layanan_id',
        'namalayanan',
        'jumlah',
        'harga',
        'jumlah_bayar'
    ];

    protected $guarded = [];
}
