<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $produks = [
            [
                'nama' => 'Beras 5kg',
                'deskripsi' => 'Beras kualitas terbaik 5kg',
                'harga' => 50000.00,
                'stok_minimal' => 10,
            ],
            [
                'nama' => 'Minyak Goreng 1L',
                'deskripsi' => 'Minyak goreng serbaguna 1 liter',
                'harga' => 15000.00,
                'stok_minimal' => 20,
            ],
            [
                'nama' => 'Gula Pasir 1kg',
                'deskripsi' => 'Gula pasir murni 1kg',
                'harga' => 12000.00,
                'stok_minimal' => 15,
            ],
            [
                'nama' => 'Teh Celup',
                'deskripsi' => 'Teh celup berkualitas, 25 kantong',
                'harga' => 8000.00,
                'stok_minimal' => 30,
            ],
            [
                'nama' => 'Kopi Instan',
                'deskripsi' => 'Kopi instan 100g',
                'harga' => 25000.00,
                'stok_minimal' => 25,
            ],
            [
                'nama' => 'Sabun Mandi',
                'deskripsi' => 'Sabun mandi wangi, 100g',
                'harga' => 5000.00,
                'stok_minimal' => 50,
            ],
            [
                'nama' => 'Susu UHT 1L',
                'deskripsi' => 'Susu UHT 1 liter, kaya nutrisi',
                'harga' => 20000.00,
                'stok_minimal' => 15,
            ],
            [
                'nama' => 'Mie Instan',
                'deskripsi' => 'Mie instan rasa ayam, 5 bungkus',
                'harga' => 15000.00,
                'stok_minimal' => 40,
            ],
            [
                'nama' => 'Cokelat Batangan',
                'deskripsi' => 'Cokelat batangan 100g',
                'harga' => 10000.00,
                'stok_minimal' => 20,
            ],
            [
                'nama' => 'Snack Keripik',
                'deskripsi' => 'Keripik kentang 200g',
                'harga' => 12000.00,
                'stok_minimal' => 30,
            ],
        ];

        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
