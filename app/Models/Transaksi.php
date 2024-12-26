<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksis';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'user_id',
        'produk_id',
        'jumlah',
        'total_harga',
        'created_at',
        'updated_at',
    ];

    // Menentukan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Menentukan relasi dengan model Item (jika ada)
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // Metode untuk menghitung total transaksi
    public function calculateTotal()
    {
        // Logika untuk menghitung total transaksi
    }
}
