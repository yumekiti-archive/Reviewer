<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Thread;
use App\Comment;
use App\Tag;
use App\ThreadTagChain;

use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    //

    public function index(){
        $threads = Thread::orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();
        $tags = Tag::orderBy('count', 'desc')->paginate(16);

        $params = [
            'threads' => $threads,
            'users' => $users,
            'tags' => $tags,
        ];

        return view('thread', $params);
    }

    public function detail($id){
        $thread = Thread::where('id', $id)->firstOrFail();
        $user = Auth::user();
        $thread->increment('views');

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
        $tags = preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $detail, $match);

        if ($req->hasFile('image')) {
            if ($req->file('image')->isValid()) {
                $image = $req->file('image')->store('images', 'public');
            }else{
                return view('create');
            }
        }
    
        $thread = Auth::user()->thread();
        $new_thread = $thread->create([
            'title' => $title,
            'detail' => $detail,
            'image' => $image,
            'user_id' => $id,
        ]);

        foreach ($match[1] as $tag) {
            $check = Tag::where('name', '=', $tag)->first();
            if ($check === null) {
                $tags = Auth::user()->tags();
                $new_tag = $tags->create([
                    'name' => $tag,            
                ]);
                $new_tag->chain()->attach([
                    'thread_id' => $new_thread->id,
                ]);
            }else{
                $check->increment('count');
                $check->chain()->attach([
                    'thread_id' => $new_thread->id,
                ]);
            }
        }

        return redirect('/thread');
    }

    public function search(Request $req){
        $keyword = $req->input('keyword');
        $sort = $req->input('sort');
        $tags = Tag::orderBy('count', 'desc')->paginate(16);
        
        $threads = null;
        switch ($sort) {
            case 1:
                $threads = Thread::orderBy('created_at', 'desc');
                break;
            case 2:
                $threads = Thread::orderBy('views', 'desc');
                break;
            case 3:
                $threads = Thread::orderBy('star', 'desc');
                break;
            default:
               echo "Not chosen";
               break;
        }

        if($keyword){
            $threads = $threads->where('title', 'like', '%' . $keyword . '%');
            $threads = $threads->orWhere('detail', 'like', '%' . $keyword . '%');
        }
        
        $threads = $threads->paginate(10);
        $users = User::all();

        $params = [
            'threads' => $threads,
            'users' => $users,
            'tags' => $tags,
        ];

        return view('thread', $params);
    }

    public function delete($id){
        if(Auth::check()){
            $thread = Thread::where('id', $id)->first();
            if(Auth::id() === $thread->user_id){
                ThreadTagChain::where('thread_id', $id)->delete();
                Comment::where('thread_id', $id)->delete();
                $thread->delete();
            }
            return redirect('/thread');
        }else{
            return redirect('/login');
        }
    }

}
