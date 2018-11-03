<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Divine Tettey', 
            'email'=>'tetteydivine0@gmail.com',
            'password'=> bcrypt('somedumbguy'),
            'email_verified_at'=> Carbon::now()
            ]);
    }
}
