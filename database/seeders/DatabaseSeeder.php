<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'first_name' => 'Mars',
            'last_name' => 'Communications',
            'email' => 'marscommunication.team@gmail.com',
            'phone' => '0755237692',
            'status' => 'active',
            'password' => Hash::make('Mars@2025')
        ]);

        // Make sure the role exists
        $role = Role::firstOrCreate(['name' => 'superuser']);

        // Assign the role to the user
        $user->assignRole($role);
    }
}
