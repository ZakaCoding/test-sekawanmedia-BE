<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => password_hash('pwd-admin1', PASSWORD_BCRYPT),
                'roles' => "admin",
            ],
            [
                'name' => 'Andy',
                'email' => 'andy@supervisor.com',
                'password' => password_hash('pwd-supervisor1', PASSWORD_BCRYPT),
                'roles' => "supervisor",
            ],
            [
                'name' => 'Jane',
                'email' => 'jane@supervisor.com',
                'password' => password_hash('pwd-supervisor1', PASSWORD_BCRYPT),
                'roles' => "supervisor",
            ],
            [
                'name' => 'John',
                'email' => 'john@supervisor.com',
                'password' => password_hash('pwd-supervisor1', PASSWORD_BCRYPT),
                'roles' => "supervisor",
            ]
        ];

        User::insert($users);
    }
}
