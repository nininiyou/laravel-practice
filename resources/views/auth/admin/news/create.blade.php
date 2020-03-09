@extends('layouts/app')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
<form method="POST" action="/home/news/store" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="img">主要圖片上傳</label>
    <input type="file" class="form-control" id="img" name="img" required>
  </div>

  <div class="form-group">
    <label for="img">多張圖片上傳</label>
    {{-- 因為有多張圖, 所以name的部分要記得用陣列的方式呈現 --}}
    {{-- 多個檔案上傳 加上mutiple即可 --}}
    <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" required multiple>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">標題</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">內容</label>
    <textarea type="text" class="form-control" id="content" name="content"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">權重(數字越大排在越前面)</label>
    <input type="text" class="form-control" id="sort" name="sort">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection

@section('js')
{{-- // summernote --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="{{asset('js/summernote_zh_tw.js')}}"></script>


<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 150,
            lang: 'zh-TW',
            callbacks: {
                onImageUpload: function(files) {
                    for(let i=0; i < files.length; i++) {
                        $.upload(files[i]);
                    }
                },
                onMediaDelete : function(target) {
                    $.delete(target[0].getAttribute("src"));
                }
            },
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.upload = function (file) {
            let out = new FormData();
            out.append('file', file, file.name);


            $.ajax({
                method: 'POST',
                url: '/home/ajax_upload_img',
                contentType: false,
                cache: false,
                processData: false,
                data: out,
                success: function (img) {
                    $('#content').summernote('insertImage', img);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error(textStatus + " " + errorThrown);
                }
            });
        };

        $.delete = function (file_link) {

                $.ajax({
                    method: 'POST',
                    url: '/home/ajax_delete_img',
                    data: {file_link:file_link},
                    success: function (img) {
                        console.log("delete:",img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }


    });




</script>
@endsection
