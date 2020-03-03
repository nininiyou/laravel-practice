<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $all_news=News::all();
       return view ('auth/admin/news/index', compact('all_news'));
   }
   
   public function create(){
     return view ('auth/admin/news/create');
}


   public function store(Request $request){
       $news_data = $request ->all();
       News::create($news_data)->save();
       return redirect('/home/news');
   }
}
