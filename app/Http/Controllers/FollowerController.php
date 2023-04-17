<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FollowerController extends Controller
{
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
