@extends('layouts/app')

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
    <input type="text" class="form-control" id="content" name="content">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">排序</label>
    <input type="text" class="form-control" id="sort" name="sort">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection
