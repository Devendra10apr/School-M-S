<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $roles = ['admin', 'teacher', 'student', 'parent'];

    foreach ($roles as $role) {
        Role::firstOrCreate(['name' => $role]);
    }
    }
}
