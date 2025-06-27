<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Palkesh Patel',
                'email' => 'patel.palkesh@gmail.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User Admin',
                'email' => 'user@admin.com',
                'password' => Hash::make('123456789'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
