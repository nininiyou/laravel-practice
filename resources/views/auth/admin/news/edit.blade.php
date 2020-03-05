@extends('layouts/app')

@section('content')

<div class="container">
    <h1>編輯最新消息</h1><hr>
<form method="POST" action="/home/news/update/{{$news->id}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="img">現有圖片</label><br>
            <img class="img-fluid" width="250" src="{{asset('/storage/'.$news->img)}}" alt="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">重新上傳圖片(建議圖片大小400*200)</label>
          <input type="file" class="form-control" id="img" name="img">
          </div>

          <div class="form-group">
            @foreach($item->news_imgs as $news_img)
            <label for="img">現有圖片組</label><br>
            <img class="img-fluid" width="250" src="{{asset('/storage/'.$news_img->img_url)}}" alt="">
          </div>
          @endforeach

          <div class="form-group">
            <label for="exampleInputEmail1">重新上傳圖片(建議圖片大小400*200)</label>
          <input type="file" class="form-control" id="img" name="img">
          </div>


          <div class="form-group">
            <label for="exampleInputPassword1">標題</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">內容</label>
            <textarea class="form-control" id="content" name="content" cols="30" row="10">{{$news->content}}</textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">排序</label>
            <input type="text" class="form-control" id="sort" name="sort" value="{{$news->sort}}">
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

@endsection
