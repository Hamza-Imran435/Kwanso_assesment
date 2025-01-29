<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $permissions = [
            ['name' => 'create-task'],
            ['name' => 'edit-task'],
            ['name' => 'delete-task'],
            ['name' => 'view-task'],
            ['name' => 'send-invites'],
            ['name' => 'resend-invites'],
            ['name' => 'manage-roles&permissions'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
