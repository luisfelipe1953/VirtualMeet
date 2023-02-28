<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $isAdmin = Role::create(['name' => 'Admin']);
  
       $isUser = Role::create(['name' => 'User']);

       Permission::create(['name' => 'admin'])->syncRoles($isAdmin);

       Permission::create(['name' => 'user'])->syncRoles($isUser);
    }
}
