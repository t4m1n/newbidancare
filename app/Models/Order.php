<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order_t';
    protected $primaryKey = 'id';
    public $incrementing = false; // Karena id adalah string, bukan auto increment

    protected $casts = [
        'statusenabled' => 'boolean',
    ];

    protected $fillable = [
        'id',
        'statusenabled',
        'pasien_id',
        'bidan_id',
        'status',
        'tglorder',
        'tglselesai',
        'total' 
    ];

    protected $guarded = [];
}
