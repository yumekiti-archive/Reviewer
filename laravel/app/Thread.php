<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;

class Thread extends Model
{
    //
    protected $fillable = ['title','detail','image', 'user_id'];

    /**
     *  Threadの所有するCommentを取得
     */
    public function comment()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     *  Threadの所有するTagを取得
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'thread_tag_chains','thread_id','tag_id');
    }
}
