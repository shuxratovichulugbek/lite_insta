<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ImageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // get all users
        $users = User::all();

        for ($i = 0; $i < 10; $i++) {
            // randomly choose a user to create the image
            $user = $users->random();

            // create the image
            $image = new Image([
                'user_id' => $user->id,
                'image_url' => $faker->imageUrl(),
                'caption' => $faker->sentence,
            ]);
            $image->save();
        }
    }
}
