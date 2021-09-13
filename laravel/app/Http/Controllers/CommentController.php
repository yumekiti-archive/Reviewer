<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Thread;
use App\Comment;

class CommentController extends Controller
{
    //
    public function add($id, Request $req){
        if(Auth::check()){

            $user_id = Auth::id();
            $message = $req->input('message');
            $star = $req->input('star');

            $comment = Auth::user()->comment();
            $comment->create([
                'message' => $message,
                'star' => $star,
                'user_id' => $user_id,
                'thread_id' => $id,
            ]);

            Thread::where('id', $id)->update([
                'star' => Comment::where('thread_id', $id)->avg('star')
            ]);

            return redirect('/thread/' . (string)$id);
        }else{
            return redirect('/login');
        }
    }
}
