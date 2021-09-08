<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Thread;

class ThreadController extends Controller
{
    //
    public function index(){
        $threads = Thread::all();

        $params = [
            'threads' => $threads,
        ];

        return view('index', $params);
    }
}
