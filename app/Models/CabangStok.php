<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabangStok extends Model
{
    use HasFactory;

    protected $table = 'cabang_stok';

    protected $fillable = [
        'cabang_id',
        'produk_id',
        'jumlah',
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
