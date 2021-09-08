<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\User;

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

}
