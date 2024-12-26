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
                'nama' => 'Produk A',
                'deskripsi' => 'Deskripsi untuk Produk A',
                'harga' => 10000.00,
                'stok_minimal' => 5,
            ],
            [
                'nama' => 'Produk B',
                'deskripsi' => 'Deskripsi untuk Produk B',
                'harga' => 15000.00,
                'stok_minimal' => 10,
            ],
            [
                'nama' => 'Produk C',
                'deskripsi' => 'Deskripsi untuk Produk C',
                'harga' => 20000.00,
                'stok_minimal' => 3,
            ],
            [
                'nama' => 'Produk D',
                'deskripsi' => 'Deskripsi untuk Produk D',
                'harga' => 25000.00,
                'stok_minimal' => 8,
            ],
            [
                'nama' => 'Produk E',
                'deskripsi' => 'Deskripsi untuk Produk E',
                'harga' => 30000.00,
                'stok_minimal' => 2,
            ],
        ];

        // Mengisi tabel produk dengan data dummy
        foreach ($produks as $produk) {
            Produk::create($produk);
        }
    }
}
