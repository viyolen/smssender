<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $row = $user->where('email','emreakdag911@gmail.com')->count();
        if (!$row){
            $user->name = "Emre";
            $user->surname = "Akdağ";
            $user->email = "emreakdag911@gmail.com";
            $user->password = Hash::make("123");
            $user->phone = "9054620979847";
            $user->save();
        }

    }
}
