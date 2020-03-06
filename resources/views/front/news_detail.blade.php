@extends('layout/nav')

@section('content')
<section class="engine"><a href="https://mobirise.info/x">css templates</a></section><section class="features3 cid-rRF3umTBWU" id="features3-7">
    <div class="container">
        <div class="media-container-row">
            <p><h1>{{$item->title}}</h1></p>

            @foreach($item->news_imgs as $news_img)
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{$news_img->img_url}}">
                    </div>
                </div>
            </div>


            @endforeach


        </div>
    </div>
</section>
@endsection

