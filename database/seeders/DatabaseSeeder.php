<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'superadmin@school-app.app',
            'school_id' => null
         ]);
        $role=Role::create(['name'=>'Super-Admin']);
        $admin->assignRole($role);
    }
}
