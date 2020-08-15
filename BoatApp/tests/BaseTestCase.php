<?php

namespace Tests;

use App\Models\User;

abstract class BaseTestCase extends TestCase {
    // PRE: run the UserSeeder in test DB
    protected function authenticatedUser()
    {
        $user = User::where('email', config('app.main_user_email'))->first();

        if ($user === null) {
            throw new  \Exception('authenticated user not found');
        }

        return $user;
    }
}