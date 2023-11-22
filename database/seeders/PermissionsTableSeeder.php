<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ** presence
        Permission::create(['name' => 'presence.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'presence.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'presence.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'presence.delete', 'guard_name' => 'web']);
    }
}
