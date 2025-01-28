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
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@kwanso.com',
            'password' => bcrypt('kwanso'),
        ]);

        $adminRole = Role::where('name', 'Admin')->first();
        $admin->roles()->attach($adminRole->id);

        $permissions = Permission::all();
        $adminRole->permissions()->attach($permissions->pluck('id'));
    }
}
