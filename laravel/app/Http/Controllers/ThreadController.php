<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;
use App\User;

class ThreadController extends Controller
{
    //
    public function index(){
        $threads = Thread::all();
        $users = User::all();

        $params = [
            'threads' => $threads,
            'users' => $users,
        ];

        return view('index', $params);
    }
}
