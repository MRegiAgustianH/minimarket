<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Cabang::create([
            'nama' => 'Cabang 1',
            'alamat' => 'Jl. Raya No. 1',
        ]);
        Cabang::create([
            'nama' => 'Cabang 2',
            'alamat' => 'Jl. Raya No. 2',
        ]);
        Cabang::create([
            'nama' => 'Cabang 3',
            'alamat' => 'Jl. Raya No. 3',
        ]);
        Cabang::create([
            'nama' => 'Cabang 4',
            'alamat' => 'Jl. Raya No. 4',
        ]);
        Cabang::create([
            'nama' => 'Cabang 5',
            'alamat' => 'Jl. Raya No. 5',
        ]);
        
    }
}
