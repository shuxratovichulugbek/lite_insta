<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FollowTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();

        foreach ($users as $user) {
            $followings = $users->except($user->id)->random(4);

            foreach ($followings as $following) {
                Follow::create([
                    'follower_id' => $user->id,
                    'following_id' => $following->id
                ]);
            }
        }

    }

}
