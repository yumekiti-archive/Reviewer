<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\User;

use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    //

    public function list(){
        $threads = Thread::all();
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

        $params = [
            'thread' => $thread,
            'user' => $user,
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

        $image = $req->file('image');

        $title = $req->input('title');
        $detail = $req->input('detail');
        $id = Auth::id();
    
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
