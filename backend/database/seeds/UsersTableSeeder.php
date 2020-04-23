<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsersTableSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('123456');

        User::create([
            'name' => 'Użytkownik testowy',
            'email' => 'test@test.com',
            'password' => $password,
        ]);
    }
}
