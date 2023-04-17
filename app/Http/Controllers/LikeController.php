<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function like(Request $request)
    {
        $user = $request->user();
        $image_id = $request->input('image_id');

        $like = Like::create([
            'user_id' => $user->id,
            'image_id' => $image_id,
        ]);

        return response()->json(['like' => $like]);
    }

    public function unlike(Request $request)
    {
        $user = $request->user();
        $image_id = $request->input('image_id');

        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json(['like' => null]);
    }

}
