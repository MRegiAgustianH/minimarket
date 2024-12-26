<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'alamat',
    ];

}
