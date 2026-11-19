<?php

namespace Database\Seeders;

use App\Enum\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $accounts = config('auth.seed_accounts');
        foreach ($accounts as $role => $credentials) {
            $password = $credentials['password'];
            if (!filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)
                || !is_string($password)
                || strlen($password) < 12
                || strlen($password) > 72) {
                throw new \RuntimeException(
                    'Set a valid email and a 12–72 byte password for the demo '.$role.' account.'
                );
            }
        }

        $user = User::create([
            'name' => 'Administrator',
            'email' => $accounts['admin']['email'],
            'password' => Hash::make($accounts['admin']['password']),
        ]);

        $user->assignRole(Role::findByName(Roles::ADMIN, 'api'));
    }
}