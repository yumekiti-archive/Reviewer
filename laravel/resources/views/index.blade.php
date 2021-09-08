@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Thread list</div>

                <div class="card-body">
                    @foreach ($threads as $thread)
                    <a href="/thread/{{$thread->id}}" style="text-decoration: none; color: black;">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">{{ $users[($thread->user_id - 1)]->name }}</p>
                                <h5 class="card-title">{{ $thread->title }}</h5>
                            </div>
                            <div class="card-footer text-muted text-right">
                                {{ $thread->updated_at }}
                            </div>
                        </div>
                        <br>
                    </a>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
