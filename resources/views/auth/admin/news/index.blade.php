@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection



@section('content')
<div class="container">
<a href="/home/news/create" class="btn btn-success">新增最新消息</a>
<hr>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Img</th>
                <th>Title</th>
                <th>Content</th>
                <th width='80px'></th>

            </tr>
        </thead>
        <tbody>
        @foreach($all_news as $item)

            <tr>
                <td>
                {{$item->img}}
                </td>
                <td>{{$item->title}}</td>
                <td>{{$item->content}}</td>
                <td>
                <a href="/home/news/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                <button class="btn btn-danger btn-sm" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
   {{ __('Logout') }}>
   刪除</button>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

<!-- <form method=POST, action="/home/news/store">
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
</form> -->
</div>

@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
@endsection
