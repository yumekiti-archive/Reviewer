@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">

                <div class="card-header">
                    <a href="/" style="text-decoration: none; color: black;"><div style="float: left;"><button type="button" class="btn btn-secondary btn-sm">Back</button></div></a>
                    <div style="text-align: right;" class="mt-1"><span>User : {{$user->name}}</span></div>
                </div>

                <div class="card-body">

                    <h3>{{$thread->title}}</h3>

                    <a href="/{{$thread->image}}">
                        <img style="display: block; margin: auto; height: 300px;" src="/{{$thread->image}}" class="image img-fluid">
                    </a><br>

                    <p class="m-3">{{$thread->detail}}</p>
                    <div class="text-right"><span>{{$thread->updated_at}}</span></div>

                    <hr>
                    <textarea class="form-control" placeholder="Comment here"style="height: 100px"></textarea>

                    <div class="footer">
                        <div style="float: left;" class="mt-4">
                            <span>Rating : </span>
                            <select class="form-select" aria-label="Default select">
                                <option value="1" selected>1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div style="text-align: right;"><button type="button" class="mt-3 btn btn-primary">Comment</button></div>
                    </div>

                </div>

            </div>

            <div  class="card mt-3">
                <!--コメントが入る-->
                <div class="card-header">
                    <div style="float: left;"><span>User : </span></div>
                    <div style="text-align: right;"><span>Rating : </span></div>
                </div>
                <div class="card-body">
                    <span>test</span>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    jQuery(function($){
        
        $('.image').hide();

        if($('.image').attr('src') != '/'){
            $('.image').show();
        }
    });
</script>