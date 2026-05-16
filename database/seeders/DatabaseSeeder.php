<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data User

        $admin = User::create([

            'name' => 'Admin',
            'username' => 'admin01',
            'email'    => 'admin01@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',

        ]);

        $hrd = User::create([

            'name' => 'HRD',
            'username' => 'hrd01',
            'email'    => 'hrd01@gmail.com',
            'password' => bcrypt('hrd123'),
            'role' => 'hrd',

        ]);

        $owner = User::create([

            'name' => 'Owner',
            'username' => 'owner01',
            'email'    => 'owner01@gmail.com',
            'password' => bcrypt('owner123'),
            'role' => 'owner',

        ]);

    }
}
