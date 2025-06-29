<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Palkesh Patel',
                'email' => 'patel.palkesh@gmail.com',
                'email_verified_at' => '2025-06-28 08:27:54',
                'password' => Hash::make('password'),
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'email_verified_at' => '2025-06-28 08:27:54',
                'password' => Hash::make('password'),
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ],
            [
                'name' => 'User Admin',
                'email' => 'user@admin.com',
                'email_verified_at' => '2025-06-28 08:27:55',
                'password' => Hash::make('password'),
                'created_at' => '2025-06-28 08:27:55',
                'updated_at' => '2025-06-28 08:27:55'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}