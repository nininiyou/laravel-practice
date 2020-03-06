@extends('layouts/app')


@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">

    <style>
        .news_imgs{
            position: relative;
        }
        .news_imgs .btn-danger{
            border-radius: 50%;
            position: absolute;
            right: 0px;
            top: -5px;
        }
        .news_imgs .sort{
            display: flex;
            margin-top: 5px;
        }
        .news_imgs label{
            margin: 0 5px;
            line-height: 37px;
        }
        .news_imgs input{
            width: 100%;
        }
    </style>
@endsection



@section('content')

<div class="container">
    <h1>編輯最新消息</h1><hr>
<form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有圖片</label><br>
            <img class="img-fluid" width="250" src="{{$news->img}}" alt="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">重新上傳圖片(建議圖片大小400*200)</label>
          <input type="file" class="form-control" id="img" name="img">
          </div>


          <div class="form-group row">
            <label for="img" class="col-sm-2 col-form-label">現有圖片組</label>
            @foreach ($news->news_imgs as $news_img)
            <div class="col-sm-2 news_imgs news_img_card" data-newsimgid="{{$news_img->id}}">
                <img class="img-fluid" src="{{$news_img->img_url}}" alt="">
                <button class="btn btn-danger btn-sm" data-newsimgid="{{$news_img->id}}" type="button">X</button>
                <div class="sort">
                    權重
                    <input class="form-control" type="text" id="sort" name="sort" value="{{$news_img->sort}}" onchange="ajax_post_sort(this,{{$news_img->id}})">
                </div>
            </div>
            @endforeach
        </div>

          <div class="form-group">
            <label for="exampleInputEmail1">新增多組圖片(建議圖片大小400*200)</label>
          <input type="file" class="form-control" id="news_imgs" name="news_imgs[]" required multiple>
          </div>


          <div class="form-group">
            <label for="exampleInputPassword1">標題</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">內容</label>
            <textarea class="form-control" id="content" name="content" cols="30" row="10">{!!$news->content!!}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">權重(數字越大排在越前面)</label>
            <input type="text" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

@endsection

@section('js')


<script>

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



        $('.news_img_card .btn-danger').click(function(){
                var newsimgid = this.getAttribute('data-newsimgid')

            $.ajax({
                method: 'POST',
                url: '/home/ajax_delete_news_imgs',
                data: {
                    newsimgid:newsimgid,
                },
                success: function(result) {
                    // console.log(result);
                    $(`.news_img_card[data-newsimgid=${newsimgid}]`).remove();
                }
            });
        });



        function ajax_post_sort(element, img_id){
            var img_id;
            var sort_value = element.value;

            $.ajax({
                url:"/home/ajax_post_sort",
                method:"post",
                data: {
                    id: img_id,
                    sort: sort_value
                },
                success: function(result){

                }
            });
        };


  </script>

{{-- // summernote --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script>
    $(document).ready(function() {
        $('#content').summernote();
    });
</script>

@endsection
