<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Tag;

class Thread extends Model
{
    //
    protected $fillable = ['title','detail','image', 'user_id'];

}
