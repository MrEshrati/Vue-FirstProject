<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Passport\Client;

class OauthClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = config('services.passport_web_client');
        if (empty($client['id']) || empty($client['secret'])) {
            throw new \RuntimeException('Set AUTH_WEB_CLIENT_ID and AUTH_WEB_CLIENT_SECRET first.');
        }

        Client::firstOrCreate(['id' => $client['id']], [
            'name' => 'Web Client',
            'secret' => $client['secret'],
            'redirect' => 'localhost:8000',
            'provider' => 'users',
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => 0,
        ]);
    }
}
