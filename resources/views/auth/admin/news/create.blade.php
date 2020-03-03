@extends('layouts/app')

@section('content')
<div class="container">
<form method="POST" action="/home/news/store">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">圖片位址</label>
    <input type="text" class="form-control" id="img" name="img">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">標題</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">內容</label>
    <input type="text" class="form-control" id="content" name="content">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection