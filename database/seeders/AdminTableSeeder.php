<?php

namespace Database\Seeders;

use App\Models\AdminUsers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingAdmin = AdminUsers::where('email', 'admin@gmail.com')->first();

        // Create admin user only if it does not exist
        if (!$existingAdmin) {
            $admin = AdminUsers::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'user_role' => 1
            ]);
        }
    }
}
