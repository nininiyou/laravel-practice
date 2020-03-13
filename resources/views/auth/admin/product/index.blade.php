@extends('layouts/app')


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endsection



@section('content')
<div class="container">
<a href="/home/product/create" class="btn btn-success">新增產品資訊</a>
<hr>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th width='100px'>產品類型名稱</th>
                <th>圖片</th>
                <th>標題</th>
                <th>內容</th>
                <th>價格</th>
                <th>權重</th>
                <th width='80px'></th>
            </tr>
        </thead>
        <tbody>
        @foreach($all_products as $item)

            <tr>
                <td>{{$item->type_id}}</td>
                <td>
                    <img width="120" src="{{$item->img}}" alt="">
               </td>
                <td>{{$item->title}}</td>
                <td>{!!$item->content!!}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->sort}}</td>
                <td>
                <a href="/home/product/edit/{{$item->id}}" class="btn btn-success btn-sm">修改</a>
                <button class="btn btn-danger btn-sm" onclick="show_confirm({{$item->id}})">刪除</button>
                <form id="delete-form-{{$item->id}}" action="/home/product/delete/{{$item->id}}" method="POST" style="display: none;">
                     @csrf
                </form>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>

@endsection

@section('js')
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable();
} );

function show_confirm(id){
    console.log(id)
    var r=confirm("你確定要刪除嗎!?");
    if (r==true){
        //使用者確認刪除
        document.getElementById('delete-form-'+id).submit();
    }
}
</script>
@endsection
