<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'caption' => 'nullable|string',
            'image' => 'required|image|max:1024',
        ]);

        $path = $request->file('image')->store('public/images');
        $validatedData['image_url'] = Storage::url($path);

        $image = Image::create($validatedData);

        return response()->json([
            'image' => $image,
        ], 201);
    }

    public function get(Image $image)
    {
        return response()->json([
            'image' => $image,
        ]);
    }

    public function update(Request $request, Image $image)
    {
        $validatedData = $request->validate([
            'caption' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($image->image_url);
            $path = $request->file('image')->store('public/images');
            $validatedData['image_url'] = Storage::url($path);
        }

        $image->update($validatedData);

        return response()->json([
            'image' => $image,
        ]);
    }

    public function delete(Image $image)
    {
        Storage::delete($image->image_url);

        $image->delete();

        return response()->json([], 204);
    }


}
