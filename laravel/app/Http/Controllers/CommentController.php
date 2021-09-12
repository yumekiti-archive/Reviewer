<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

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

            return redirect('/thread/' . (string)$id);
        }else{
            return redirect('/login');
        }
    }
}
