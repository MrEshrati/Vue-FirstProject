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
        $user = User::create([
        'name' => 'Arshiaeshz',
        'email' => 'REDACTED',
        'password' => Hash::make('REDACTED')]);

        $user->assignRole(Role::findByName(Roles::ADMIN, 'api'));
    }
}