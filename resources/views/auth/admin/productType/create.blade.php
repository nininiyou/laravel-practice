@extends('layouts/app')

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
<form method="POST" action="/home/productType/store" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="exampleInputPassword1">產品類型名稱</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">副標題</label>
    <textarea type="text" class="form-control" id="subtitle" name="subtitle"></textarea>
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
