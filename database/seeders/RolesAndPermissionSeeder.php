<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'access dashboard']);

        Permission::create(['name' => 'access users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'access roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'access buildings']);
        Permission::create(['name' => 'create buildings']);
        Permission::create(['name' => 'edit buildings']);
        Permission::create(['name' => 'delete buildings']);

        Permission::create(['name' => 'access supply and equipments']);
        Permission::create(['name' => 'create supply and equipments']);
        Permission::create(['name' => 'edit supply and equipments']);
        Permission::create(['name' => 'delete supply and equipments']);

        Permission::create(['name' => 'access reports']);
        Permission::create(['name' => 'generate reports']);

        Permission::create(['name' => 'access app settings']);

        Permission::create(['name' => 'access profile']);
        Permission::create(['name' => 'edit profile']);

        Permission::create(['name' => 'access workflows']);
        Permission::create(['name' => 'create workflows']);
        Permission::create(['name' => 'edit workflows']);
        Permission::create(['name' => 'delete workflows']);

        Permission::create(['name' => 'access forms']);
        Permission::create(['name' => 'create forms']);
        Permission::create(['name' => 'edit forms']);
        Permission::create(['name' => 'delete forms']);

        Permission::create(['name' => 'access faqs']);
        Permission::create(['name' => 'create faqs']);
        Permission::create(['name' => 'edit faqs']);
        Permission::create(['name' => 'delete faqs']);

        Permission::create(['name' => 'access tickets']);
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);
        Permission::create(['name' => 'assign tickets']);
        Permission::create(['name' => 'open tickets']);
        Permission::create(['name' => 'in-progress tickets']);
        Permission::create(['name' => 'closed tickets']);

        // Create roles and assign existing permissions
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $superAdminRole->givePermissionTo(Permission::all());

    }
}
