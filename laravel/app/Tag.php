<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = ['name'];

    /**
     *  中間テーブル
     */
    public function chain()
    {
        return $this->belongsToMany(Tag::class,'thread_tag_chains','tag_id','thread_id');
    }

}
