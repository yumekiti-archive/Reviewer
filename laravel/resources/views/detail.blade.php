@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="/{{$thread->image}}">
                <img style="display: block; margin: auto;" src="{{$thread->image}}" class="img-fluid">
            </a><br>

            <div class="card">

                <div class="card-header">
                    <a href="/" style="text-decoration: none; color: black;"><div style="float: left;"><button type="button" class="btn btn-secondary btn-sm">Back</button></div></a>
                    <div style="text-align: right;" class="mt-1"><span>user_name：{{$user->name}}</span></div>
                </div>

                <div class="card-body">
                    <h3>{{$thread->title}}</h3>
                    <p class="m-3">{{$thread->detail}}</p>
                    <div class="text-right"><span>{{$thread->updated_at}}</span></div>

                    <hr>
                    <textarea class="form-control" placeholder="Comment here"style="height: 100px"></textarea>
                    <div class="text-right"><button type="button" class="mt-3 btn btn-primary">Comment</button></div>
                </div>

            </div>

            <div  class="card mt-3">
                <!--コメントが入る-->
                <div class="card-header">
                    <div style="float: left;"><span>user_name：</span></div>
                    <div style="text-align: right;"><span>star</span></div>
                </div>
                <div class="card-body">
                    <span>test</span>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
