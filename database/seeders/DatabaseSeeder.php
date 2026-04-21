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

        $admin = User::create([

            'name' => 'Admin02',
            'username' => 'admin',
            'email'    => 'admin012@gmail.com',
            'password' => bcrypt('admin07'),
            'role' => 'admin',

        ]);

        $pegawai = User::create([

            'name'     => 'Budi Santoso',
            'username' => 'BudiSan',
            'email'    => 'budisantoso01@gmail.com',
            'password' => bcrypt('pegawai123'),
            'role'     => 'pegawai',

        ]);

        $pegawai = User::create([

            'name'     => 'Nazran Arkan',
            'username' => 'Nazran',
            'email'    => 'nazranarkan@gmail.com',
            'password' => bcrypt('pegawai12'),
            'role'     => 'pegawai',

        ]);
    }
}
