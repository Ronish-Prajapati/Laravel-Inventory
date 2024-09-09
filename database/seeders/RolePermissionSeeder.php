<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
    $admin = Role::create(['name' => 'Admin']);
    $customer = Role::create(['name' => 'Customer']);
    $supplier = Role::create(['name' => 'Supplier']);

    // Create permissions
    $viewProducts = Permission::create(['name' => 'view products']);
    $createProducts = Permission::create(['name' => 'create products']);
    $editProducts = Permission::create(['name' => 'edit products']);
    $deleteProducts = Permission::create(['name' => 'delete products']);

    // Assign permissions to roles
    $admin->givePermissionTo([$viewProducts, $createProducts, $editProducts, $deleteProducts]);
    $customer->givePermissionTo([$viewProducts]);
    $supplier->givePermissionTo([$viewProducts]);
    }
    
}
