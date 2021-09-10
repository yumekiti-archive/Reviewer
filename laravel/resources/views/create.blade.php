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

                <form action="/thread" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div>
                            <span>Title : </span>
                            <span class="now_cnt_title">0</span> / 50
                        </div>
                        <div>
                            <input type="text" class="form-control title" placeholder="Title here" name="title">
                        </div>
                        <div class="my-3">
                            <span class="image-info"></span>
                            <input type="file" class="form-control-file" id="inputFile" name="image">
                        </div>
                        <div>
                            <div>
                                <span>Detail : </span>
                                <span class="now_cnt">0</span> / 1000
                            </div>
                            <textarea style="height: 500px;" class="detail form-control" name="detail"></textarea>
                        </div>
                        <div class="mt-3 text-right post_btn"><input type="submit" class="post_btn" value="Create" disabled></div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
    jQuery(function($){
        $('.alert').hide();
        $('.title').on('input', function(){
            var cnt = $(this).val().length;
            $('.now_cnt_title').text(cnt);
            if(cnt >= 0 && 50 >= cnt){
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
        
        $(function() {
            $('input[type=file]');
            $('.image-info').text('Image : Not Selected');

            // アップロードするファイルを選択
            $('input[type=file]').change(function() {
                var file = $(this).prop('files')[0];
                $('.image-info').text('Filename : ' + file.name + ' / Size : ' + getFiseSize(file.size) + ' / Type : ' + file.type);
            });
        });

        /** 
         * ファイルサイズの単位
         * @param {int} file_size 
         * @return {string}
         */
        function getFiseSize(file_size)
        {
            var str;

            // 単位
            var unit = ['byte', 'KB', 'MB', 'GB', 'TB'];

            for (var i = 0; i < unit.length; i++) {
                if (file_size < 1024 || i == unit.length - 1) {
                    if (i == 0) {
                        // カンマ付与
                        var integer = file_size.toString().replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');
                        str = integer +  unit[ i ];
                    } else {
                        // 小数点第2位は切り捨て
                        file_size = Math.floor(file_size * 100) / 100;
                        // 整数と小数に分割
                        var num = file_size.toString().split('.');
                        // カンマ付与
                        var integer = num[0].replace(/([0-9]{1,3})(?=(?:[0-9]{3})+$)/g, '$1,');
                        if (num[1]) {
                            file_size = integer + '.' + num[1];
                        }
                        str = file_size +  unit[ i ];
                    }
                    break;
                }
                file_size = file_size / 1024;
            }

            return str;
        }

    });
</script>