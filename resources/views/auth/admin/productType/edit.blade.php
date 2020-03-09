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
    <h1>編輯產品資訊</h1><hr>
<form method="POST" action="/home/productType/update/{{$products->id}}" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
            <label for="exampleInputPassword1">產品類型名稱</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$products->title}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">副標題</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{$products->subtitle}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">權重(數字越大排在越前面)</label>
            <input type="text" class="form-control" id="sort" name="sort" value="{{$products->sort}}">
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
