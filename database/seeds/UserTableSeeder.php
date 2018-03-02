<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 \DB::table('users')->truncate();
        //
        $User = new \App\User();
        $User->name = "Vijay Bajrot";
        $User->email = "vijaybajrot@gmail.com";
        $User->username = "vijaybajrot";
        $User->password = bcrypt("bajrot");
        $User->user_group = "1";
        $User->remember_token = uniqid();
        $User->save();
    }
}
