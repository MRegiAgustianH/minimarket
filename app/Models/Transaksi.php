<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksis';

    
    protected $fillable = [
        'cabang_id',
        'user_id',
        'produk_id',
        'jumlah',
        'total_harga',
        'created_at',
        'updated_at',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cabang(){
        return $this->belongsTo(Cabang::class);
    }


    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    
    public function calculateTotal()
    {
        
    }
}
