<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            'name' => 'Pak Jayusman',
            'email' => 'jayusman@gmail.com',
        ])->assignRole('owner')->givePermissionTo('edit_cabang','edit_user');

        User::factory()->create([
            'name' => 'Regi',
            'email' => 'regi@gmail.com',
        ])->assignRole('manager')
        ->givePermissionTo(['view_transaksi','view_stok']);

        User::factory()->create([
            'name' => 'supervisor1',
            'email' => 'supervisor1@gmail.com',
            'cabang_id' => 1,
        ])->assignRole('supervisor')
        ->givePermissionTo(['view_transaksi']);

        User::factory()->create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'cabang_id' => 1,
        ])->assignRole('kasir');

        User::factory()->create([
            'name' => 'pegawai',
            'email' => 'pegawai@gmail.com',
        ])->assignRole('pegawai');
    }
}
