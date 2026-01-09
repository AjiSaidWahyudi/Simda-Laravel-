<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Buat daftar permission berdasarkan modul & sub-menu
        $permissions = [
            'kartu_ruang',
            'inventarisasi',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // 3. Buat Role dan assign permission
        $adminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $adminRole->givePermissionTo(Permission::all());

        // 4. Buat User dan assign Role
        $adminUser = User::firstOrCreate(
            ['email' => 'superadmin@simda.com', 'username' => 'superadmin'],
            ['name' => 'Super Admin', 'password' => bcrypt('12345678'), 'keterangan' => 'Super Admin bisa akses semua'],
        );
        $adminUser->assignRole('superadmin');
    }
}
