<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Thread;
use App\Comment;

use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    //

    public function index(){
        $threads = Thread::orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();

        $params = [
            'threads' => $threads,
            'users' => $users,
        ];

        return view('thread', $params);
    }

    public function detail($id){
        $thread = Thread::where('id', $id)->firstOrFail();
        $user = User::where('id', $thread->user_id)->firstOrFail();

        $users = User::all();
        $comments = Comment::where('thread_id', $id)->orderBy('created_at', 'desc')->paginate(10);

        $params = [
            'user' => $user,
            'thread' => $thread,
            'users' => $users,
            'comments' => $comments,
        ];

        return view('detail', $params);
    }

    public function create(){
        if(Auth::check()){
            return view('create');
        }else{
            return redirect('/login');
        }
    }

    public function add(Request $req){
        
        $image = null;
        $title = $req->input('title');
        $detail = $req->input('detail');
        $id = Auth::id();

        if ($req->hasFile('image')) {
            if ($req->file('image')->isValid()) {
                $image = $req->file('image')->store('images', 'public');
            }else{
                return view('create');
            }
        }
    
        $thread = Auth::user()->thread();
        $thread->create([
            'title' => $title,
            'detail' => $detail,
            'image' => $image,
            'user_id' => $id,
        ]);

        return redirect('/thread');

    }

}
