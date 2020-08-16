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

    // PRE: less than $maxId number of entries in table in table
    protected function nonExistentId($model, $maxId = 10000) {
        do {
            $randId = rand(1, $maxId);
        } while ($model::find($randId) !== null);
        return $randId;
    }

    protected function postApi($uri, array $data = [], array $headers = [])
    {
        $headers['Accept'] = 'application/json';
        return $this->post($uri, $data, $headers);
    }

    protected function putApi($uri, array $data = [], array $headers = [])
    {
        $headers['Accept'] = 'application/json';
        return $this->put($uri, $data, $headers);
    }

    protected function deleteApi($uri, array $data = [], array $headers = [])
    {
        $headers['Accept'] = 'application/json';
        return $this->delete($uri, $data, $headers);
    }
}
