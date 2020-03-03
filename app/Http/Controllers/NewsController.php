<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $all_news = News::all();
        return view('auth/admin/news/index', compact('all_news'));
    }

    // 新增並儲存至SQL database
    // 1. 先連到對應的新增介面
    public function create()
    {
        return view('auth/admin/news/create');
    }
    // 2. 再儲存新增的資料
    public function store(Request $request)
    {
        $news_data = $request->all();
        News::create($news_data)->save();
        return redirect('/home/news');
    }

    // 可針對特定項目做修改
    // 1. 先抓到對應的id
    public function edit($id)
    {
        // 寫法1
        // $news = News::where('id'.'=',$id)->first();
        // 寫法2
        $news = News::find($id);

        return view('auth/admin/news/edit', compact('news'));
    }
    // 2. 再將修改的內容更新上去
    public function update(Request $request, $id){
        // 寫法1
        // 將舊的資料一個一個透過新生成的request來取代
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        // 寫法2
        News::find($id)->update($request->all());

        return redirect('/home/news');
    }


    public function delete(Request $request, $id){
        $news = News::find($id)->delete();
        return redirect('/home/news');
    }
}
