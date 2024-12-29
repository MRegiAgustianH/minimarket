<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\CabangStok;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangStokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $cabangs = Cabang::all();
        $produks = Produk::all();

        foreach ($cabangs as $cabang) {
            foreach ($produks as $produk) {
                CabangStok::create([
                    'cabang_id' => $cabang->id,
                    'produk_id' => $produk->id,
                    'jumlah' => rand(1, 100), 
                ]);
            }
        }
    
    }
}
