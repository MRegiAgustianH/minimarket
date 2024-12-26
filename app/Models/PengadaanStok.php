<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengadaanStok extends Model
{
    use HasFactory;

    protected $table = 'pengadaan_stok';

    protected $fillable = [
        'cabang_id',
        'produk_id',
        'jumlah',
        'tanggal_pengadaan',
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
