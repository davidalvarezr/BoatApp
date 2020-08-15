<?php

namespace Tests;

use App\Models\User;

abstract class BaseTestCase extends TestCase
{
    // PRE: run the UserSeeder in test DB
    protected function authenticatedUser()
    {
        $user = User::where('email', config('app.main_user_email'))->first();

        if ($user === null) {
            throw new  \Exception('authenticated user not found');
        }

        return $user;
    }

    public function
    postApiWithAuth($uri, array $data = [], array $headers = [])
    {
        $user = $this->authenticatedUser();
        $token = $user->createToken('test')->accessToken;
        $headers['Authorization'] = 'Bearer ' . $token;
        $headers['Accept'] = 'application/json';
        return $this->post($uri, $data, $headers);
    }

    public function postApiWithoutAuth($uri, array $data = [], array $headers = [])
    {
        $headers['Accepts'] = 'application/json';
        return $this->post($uri, $data, $headers);
    }
}
