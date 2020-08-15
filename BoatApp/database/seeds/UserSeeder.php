<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => config('app.main_user_name'),
            'email' => config('app.main_user_email'),
            'password' => Hash::make(config('app.main_user_password')),
        ]);
    }
}
