<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function index(Request $request, $image_id)
    {
        $comments = Comment::where('image_id', $image_id)->get();

        return response()->json(['comments' => $comments]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $image_id = $request->input('image_id');
        $text = $request->input('text');

        $comment = Comment::create([
            'user_id' => $user->id,
            'image_id' => $image_id,
            'text' => $text,
        ]);

        return response()->json(['comment' => $comment]);
    }

    public function update(Request $request, $comment_id)
    {
        $user = $request->user();
        $text = $request->input('text');

        $comment = Comment::where('id', $comment_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $comment->text = $text;
        $comment->save();

        return response()->json(['comment' => $comment]);
    }

    public function destroy(Request $request, $comment_id)
    {
        $user = $request->user();

        $comment = Comment::where('id', $comment_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $comment->delete();

        return response()->json(['comment' => null]);
    }


}
