<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create(['name' => 'owner']);
        Permission::create(['name' => 'edit_cabang']);
        Permission::create(['name' => 'edit_user']);

        Role::create(['name' => 'manager']);
        Permission::create(['name' => 'view_transaksi']);
        Permission::create(['name' => 'view_stok']);

        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'kasir']);
        Role::create(['name' => 'pegawai']);
    }
}
