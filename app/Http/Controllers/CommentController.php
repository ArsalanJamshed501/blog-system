<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\PostInteractionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        $request->validate([
            'content' => 'required|max:500'
        ]);
        Comment::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);

        if($post->user_id <> Auth::id()) {
            $post->user->notify(new PostInteractionNotification(Auth::user(), $post, 'comment'));
        }

        return redirect()->route('posts.show', $post)->with('success', 'Comment added!');
    }

    public function destroy(Comment $comment) {
        if(Auth::user()->cannot('delete', $comment)) {
            abort(403);
        }

        // redundant if block.
        if(Auth::id() <> $comment->user_id) {
            return back()->with('error', 'Unauthorized action!');
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }
}
