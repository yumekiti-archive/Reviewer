<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThreadTagChain extends Model
{
    //
    protected $fillable = ['thread_id','tag_id'];
}
