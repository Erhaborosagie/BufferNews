<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('adminPass'),
            'role'=>'admin'
        ]);
        User::create([
            'name' => 'Author',
            'email' => 'author@example.com',
            'password' => Hash::make('authorPass'),
            'role' => 'author'
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('userPass'),
        ]);

    }
}
