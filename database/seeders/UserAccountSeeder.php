<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $fakeuser = User::create(
                implode("", explode(" ", $faker->name())),
                $faker->email(),
                '123'
            );

            $fakeuser->save();

            User::create_display_data($fakeuser->id);
        }
    }
}
