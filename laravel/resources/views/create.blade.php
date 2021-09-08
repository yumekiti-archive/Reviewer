@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="alert alert-success" role="alert">
                It was created.
            </div>

            <div class="card">
                <div class="card-header">
                    <span>Create</span>
                </div>

                <div class="card-body">
                    <div><span class="now_cnt_title">Title：0</span> / 50</div>
                    <div>
                        <input type="text" class="form-control title" placeholder="Title here">
                    </div>
                    <div class="my-3">
                        <input type="file" class="form-control-file" id="inputFile">
                    </div>
                    <div>
                        <div>
                            <span>Detail：</span>
                            <span class="now_cnt">0</span> / 300
                        </div>
                        <textarea style="height: 500px;" class="detail form-control"></textarea>
                        <script>
                            jQuery(function($){
                                $('.alert').hide();
                                $('.title').on('input', function(){
                                    var cnt = $(this).val().length;
                                    $('.now_cnt_title').text(cnt);
                                    if(cnt > 0 && 50 > cnt){
                                        $('.post_btn').prop('disabled', false);                           
                                    }else{
                                        $('.post_btn').prop('disabled', true);
                                    }
                                });
                                $('.detail').on('input', function(){
                                    var cnt = $(this).val().length;
                                    $('.now_cnt').text(cnt);
                                });
                                $('.detail').trigger('input');
                                $('.post_btn').click(function(){
                                    $('.alert').show();
                                });
                            });
                        </script>
                    </div>
                    <div class="mt-3 text-right post_btn"><input type="button" class="post_btn" value="submit" disabled></div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>