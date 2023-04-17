<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowController extends Controller
{
    public function follow(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $follower = Auth::user();
        $followee = $user;

        $existingFollow = Follow::where([
            'follower_id' => $follower->id,
            'followee_id' => $followee->id,
        ])->first();

        if ($existingFollow) {
            return response()->json(['message' => 'Already following'], 400);
        }

        $follow = new Follow;
        $follow->follower_id = $follower->id;
        $follow->followee_id = $followee->id;
        $follow->save();

        return response()->json(['message' => 'Successfully followed'], 201);
    }

    public function unfollow(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $follower = Auth::user();
        $followee = $user;

        $existingFollow = Follow::where([
            'follower_id' => $follower->id,
            'followee_id' => $followee->id,
        ])->first();

        if (!$existingFollow) {
            return response()->json(['message' => 'Not following'], 400);
        }

        $existingFollow->delete();

        return response()->json(['message' => 'Successfully unfollowed'], 200);
    }

    public function followers(User $user)
    {
        $followers = $user->followers()->get();

        return response()->json(['followers' => $followers], 200);
    }

    public function following(User $user)
    {
        $following = $user->following()->get();

        return response()->json(['following' => $following], 200);
    }
}
