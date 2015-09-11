<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'user_name' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        $faker = Faker::create();
        $password = bcrypt('secret');
        foreach (range(1, 100) as $index)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'user_name' => $faker->firstName . '_' . $faker->lastName
            ]);
        }

        Model::reguard();
    }
}
