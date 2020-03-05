<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view ('front/index');
    }

    public function news(){
        $news_d = News::orderBy('sort','DESC')->get();
        return view ('front/news', compact('news_d'));
    }

    public function news_detail($id){
        $item = News::find($id);
        // $item = News::with('news_imgs')->find($id);
        return view('front/news_detail', compact('item'));

    }


}