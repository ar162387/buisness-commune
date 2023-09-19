<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        $faker = Faker::create();

        foreach(range(1 ,5) as $index)
        {
            $user = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'email_verified_at' => NOW(),
                'password' => $faker->password(),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ];

            $users[] = $user;


        }
        DB::table('users')->delete();
        DB::table('users')->insert($users);
    }
}
