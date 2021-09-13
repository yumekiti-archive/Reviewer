@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-9 mb-3">
            <div class="card">
                
                <div class="card-header">

                    <div class="default">
                        <div style="float: left;" class="mt-1"><span>Thread list</span></div>
                        <div style="text-align: right;">
                            <button type="button" class="search-btn btn btn-secondary btn-sm">Search</button>
                            <a href="/create"><button type="button" class="btn btn-primary btn-sm">New</button></a>
                        </div>
                    </div>

                    <div class="search">
                        <div style="float: left;"><button type="button" class="back btn btn-secondary btn-sm">Back</button></div>
                        <div style="text-align: right;">
                            <form action="/search" method="post" style="margin: auto 0;">
                                {{ csrf_field() }}

                                <input class="col-5" type="text" name="keyword">
                                
                                <input type="submit" class="search-btn btn btn-primary btn-sm" value="Search">

                                <select class="btn-outline-primary" name="sort">
                                    <option value="1">New</option>
                                    <option value="2">Popular</option>
                                    <option value="3">Rating</option>
                                </select>

                            </form>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    @foreach ($threads as $thread)
                    <a href="/thread/{{$thread->id}}" style="text-decoration: none; color: black;">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">User : {{ $users[($thread->user_id - 1)]->name }}</p>
                                <h5 class="card-title">{{ $thread->title }}</h5>
                            </div>
                            <div class="small card-footer text-muted text-right">
                                {{ $thread->updated_at }}
                            </div>
                        </div>
                        <br>
                    </a>
                    @endforeach
                </div>

                <div style="margin: 0 auto;">
                    {{$threads->links()}}
                </div>
                
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <span>Tag ranking</span>
                </div>
                <div class="card-body">
                    @foreach ($tags as $tag)
                        <div class="card mb-3">
                            <form action="/search" method="post" class="search-tag" style="margin: auto 0;">
                            {{ csrf_field() }}
                                <input type="hidden" name="sort" value="1">
                                <input type="hidden" name="keyword" value="#{{$tag->name}}">
                                <div class="card-body search-card">
                                    <h5>#{{$tag->name}}</h5>
                                    <span>count : {{$tag->count}}</span>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div style="margin: 0 auto;">
                    {{$tags->links()}}
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    jQuery(function($){
        $('.search').hide();
        
        $('.search-btn').click(function() {
            $('.search').show();
            $('.default').hide();
        });

        $('.back').click(function() {
            $('.search').hide();
            $('.default').show();
        });

        $('.search-card').click(function() {
            $('.search-tag').submit();
        });
    });
</script>

<style>
select {
    text-align:-webkit-center;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border: 0;
    outline: none;
    background: transparent;
    color: #6699CC;
}
</style>