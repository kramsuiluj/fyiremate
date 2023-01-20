<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::find(1)) {
            $admin = User::factory()->create([
                'username' => 'admin',
                'rank' => 'Administrator',
                'firstname' => 'Mark Julius',
                'middlename' => 'Relos',
                'lastname' => 'Maravillo',
                'is_admin' => true,
                'password' => bcrypt('!password')
            ]);
        }
    }
}
