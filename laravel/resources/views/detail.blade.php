@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <a href="{{$thread->image}}">
                <img style="display: block; margin: auto;" src="{{$thread->image}}" class="img-fluid">
            </a><br>

            <div class="card">
                <div class="card-header">
                    <div style="float: left;"><span>Detail</span></div>
                    <div style="text-align: right;"><span>user_name：{{$user->name}}</span></div>
                </div>

                <div class="card-body">
                    <h3>{{$thread->title}}</h3>
                    <p class="m-3">{{$thread->detail}}</p>
                    <div class="text-right"><span>{{$thread->updated_at}}</span></div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
