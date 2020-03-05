<?php

namespace App\Http\Controllers;

use App\News;
use App\News_Img;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        //上傳檔案, 並存到config/filesysytems裡所定義的public位置
        $file_name = $request->file('img')->store('', 'public');
        $news_data['img'] = $file_name;

        // News::create($news_data);
        // return redirect('/home/news');

        // -------------------------------------------

        // 變成多張圖上傳改寫
        $new_news = News::create($news_data);

        if($request->hasFile('news_imgs')){
            $files = $request->file('news_imgs');
            foreach ($files as $file){
                // 上傳圖片
                $file_name = $request->file('img')->store('', 'public');

                //建立News多張圖片的資料
                $news_imgs = new News_Img;
                $news_imgs->news_id = $new_news->id;
                $news_imgs->img_url = $file_name;
                $news_imgs->save();


            }
        }
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
    public function update(Request $request, $id)
    {
        // 寫法1
        // 將舊的資料一個一個透過新生成的request來取代
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        // 寫法2
        // News::find($id)->update($request->all());

        // 為了可以順利編修並刪除舊資料, 改寫如下:

        // 寫法3
        $item = News::find($id);
        $old_image = $item->img;
        Storage::disk('public')->delete($old_image);
        // DB::table('news')->delete($id);

        // 寫法4

        // $request_data = $request->all();
        // $item = News::find($id);

        // 如果有上傳新圖片
        // if ($request->hasFile('img')) {
        //     $old_image = $item->img;
        //     $file = $request->file('img');
        //     $path = $this->fileUpload($file, 'product');
        //     $requsetData['img'] = $path;
        //     File::delete(public_path() . $old_image);
        // }

        // $item->update($requsetData);


        return redirect('/home/news');
    }


    public function delete(Request $request, $id)
    {
        $news = News::find($id)->delete();
        return redirect('/home/news');
    }
}
