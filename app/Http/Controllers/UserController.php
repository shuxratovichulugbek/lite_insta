<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{



    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/images');
            $validatedData['profile_image_url'] = Storage::url($path);
        }

        $user = User::create($validatedData);

        return response()->json([
            'user' => $user,
        ], 201);
    }

    public function get(User $user)
    {
        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('profile_image')) {
            Storage::delete($user->profile_image_url);
            $path = $request->file('profile_image')->store('public/images');
            $validatedData['profile_image_url'] = Storage::url($path);
        }

        $user->update($validatedData);

        return response()->json([
            'user' => $user,
        ]);
    }

    public function delete(User $user)
    {
        Storage::delete($user->profile_image_url);

        $user->delete();

        return response()->json([], 204);
    }
}
