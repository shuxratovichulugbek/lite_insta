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
        {
            $users = User::all();
            $images = Image::all();

            foreach ($users as $user) {
                $likedImages = $images->random(25);
                foreach ($likedImages as $image) {
                    $like = factory(Like::class)->create([
                        'user_id' => $user->id,
                        'image_id' => $image->id,
                    ]);
                }
            }
        }
    }
}
