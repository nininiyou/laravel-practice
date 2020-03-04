@extends('layouts/app')

@section('content')
<div class="container">
<form method="POST" action="/home/news/store" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="img">圖片位址</label>
    <input type="file" class="form-control" id="img" name="img" required>
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
