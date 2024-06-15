<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'name'=>'john',
                'email'=>'john@mail.com',
                'password'=>Hash::make('12345')
            ]
            );
    }
}
