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
            'name' => 'ALING',
            'email' => 'aling@gmail.com',
        ])->assignRole('manager')
        ->givePermissionTo(['view_transaksi','view_stok']);

        User::factory()->create([
            'name' => 'OKONG',
            'email' => 'okong@gmail.com',
            'cabang_id' => 1,
        ])->assignRole('supervisor')
        ->givePermissionTo(['view_transaksi']);
    }
}
