<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
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

        // Logic to create access token also for de TEST DB --------------------------------------------------

        DB::table('oauth_clients')->insert([
            'name' => 'test',
            'secret' => '1VTT2ni3bhIbngvnbHDCHHr6vYS8BItMBobnLMop',
            'redirect' => 'http://localhost',
            'personal_access_client' => 1,
            'password_client' => 0,
            'revoked' => 0,
        ]);

        $client = DB::table('oauth_clients')
            ->select()
            ->where('secret', '1VTT2ni3bhIbngvnbHDCHHr6vYS8BItMBobnLMop')
            ->first();

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
        ]);

        // -------------------------------------------------------------------------------------------------------------

        User::create([
            'name' => config('app.main_user_name'),
            'email' => config('app.main_user_email'),
            'password' => Hash::make(config('app.main_user_password')),
        ]);

    }
}
