@extends('layouts/app')

@section('content')

<div class="container">
    <h1>編輯最新消息</h1>
<form method="POST" action="/home/news/update/{{$news->id}}">
        @csrf
          <div class="form-group">
            <label for="exampleInputEmail1">圖片位址</label>
          <input type="text" class="form-control" id="img" name="img" value="{{$news->img}}">

          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">標題</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$news->title}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">內容</label>
            <textarea class="form-control" id="content" name="content" cols="30" row="10">{{$news->content}}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
</div>

@endsection
