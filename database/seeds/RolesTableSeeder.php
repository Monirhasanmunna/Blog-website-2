<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Role::insert([

            'name'=>'Admin',
            'slug'=>'admin'

        ]);

        App\Role::insert([

            'name'=>'Author',
            'slug'=>'author'

        ]);
    }
}
