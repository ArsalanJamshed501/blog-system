<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Notifications\PostInteractionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Post $post) {
        $user = Auth::user();

        if($post->isLikedBy($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
            return back()->with('success', 'Like removed!');
        } else {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id
            ]);

            if($post->user_id <> $user->id) {
                $post->user->notify(new PostInteractionNotification($user, $post, 'like'));
            }
            
            return back()->with('success', 'Post liked!');
        }
    }
}
