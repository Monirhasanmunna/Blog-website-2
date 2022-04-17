<?php

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
        App\User::insert([

            'roles_id'=>'1',
            'name'=>'Munna',
            'username'=>'Admin',
            'email'=>'admin@gmail.com',
            'password' => Hash::make('11111111'),

        ]);

        App\User::insert([

            'roles_id'=>'2',
            'name'=>'Sakib',
            'username'=>'Author',
            'email'=>'author@gmail.com',
            'password' => Hash::make('22222222'),

        ]);
    }
}
