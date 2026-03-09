<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@attila.com'], // avoid duplicates
            [
                'name' => 'Super Admin',
                'phonenumber' => '0700000000',   // optional, fill dummy number
                'password' => bcrypt('Attila2026'), // change to strong password
                'role' => 'admin',
                'status' => 'approved',           // required since you added status column
            ]
        );
    }
}
