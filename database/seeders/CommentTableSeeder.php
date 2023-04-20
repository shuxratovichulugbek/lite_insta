<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // get all users and images
        $users = User::all();
        $images = Image::all();

        foreach ($images as $image) {
            // create between 1 and 5 comments for each image
            $numComments = rand(1, 5);
            for ($i = 0; $i < $numComments; $i++) {
                // randomly choose a user to make the comment
                $user = $users->random();

                // create the comment
                $comment = new Comment([
                    'user_id' => $user->id,
                    'image_id' => $image->id,
                    'comment' => $faker->sentence,
                ]);
                $comment->save();
            }
        }
    }
}

