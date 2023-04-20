<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Seeder;


class LikesTableSeeder extends Seeder
{
    public function run()
    {
        // get all users and images
        $users = User::all();
        $images = Image::all();

        foreach ($images as $image) {
            // randomly choose a user to like the image
            $user = $users->random();

            // create the like
            $like = new Like([
                'user_id' => $user->id,
                'image_id' => $image->id,
            ]);
            $like->save();
        }
    }
}
