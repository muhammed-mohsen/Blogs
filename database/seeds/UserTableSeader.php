<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','muhammed.mohsen43@gamil.com')->first();
        if(!$user)
        {
            User::create([
                'name'=>'gotohell',
                'email'=>'muhammed.mohsen43@gmail.com',
                'role'=>'admin',

                'password'=>Hash::make('password'),




            ]);

        }
    }
}
