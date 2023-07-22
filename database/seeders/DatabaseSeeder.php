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
        //$this->call(SubAppLinkSeeder::class);
        // \App\Models\User::factory(10)->create();

        $admin=User::factory()->create([
             'name' => 'SuperAdmin',
             'email' => 'superadmin@example.com',
            'school_id' => 1
         ]);
        $user=User::factory()->create([
            'name' => 'Test user',
            'email' => 'testuser@example.com','school_id' => 1
        ]);
        $role=Role::create(['name'=>'Admin']);
        $admin->assignRole($role);
    }
}
