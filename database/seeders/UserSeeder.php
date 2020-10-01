<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        if(count(\App\Models\User::all()) > 1)
        {
            return;
        }

        $faker = \Faker\Factory::create();
        for($i=0; $i<11; $i++){
            $user = new \App\Models\User();
            $user->name = $faker->name();
            $user->email = $faker->email;
            $user->password = \Illuminate\Support\Facades\Hash::make('password');
            $user->save();
        }

    }
}