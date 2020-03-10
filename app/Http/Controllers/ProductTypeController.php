<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductTypeController extends Controller
{
    public function index()
    {
        $all_products = ProductType::all();
        return view('auth/admin/productType/index', compact('all_products'));
    }

    // 新增並儲存至SQL database
    // 1. 先連到對應的新增介面
    public function create()
    {
        return view('auth/admin/productType/create');
    }
    // 2. 再儲存新增的資料
    public function store(Request $request)
    {
        $products_data = $request->all();
        ProductType::create($products_data);

        return redirect('/home/productType');
    }


    // 可針對特定項目做修改
    // 1. 先抓到對應的id
    public function edit(Request $request, $id)
    {
        // 寫法1
        $products = ProductType::find($id);
        // $products->update($request->all());

        return view('auth/admin/productType/edit', compact('products'));
    }
    // 2. 再將修改的內容更新上去
    public function update(Request $request, $id)
    {
        $request_data = $request->all();
        $item = ProductType::find($id);
        $item->update($request_data);
        return redirect('/home/productType');
    }


    public function delete(Request $request, $id)
    {
        $item = ProductType::find($id);
        $old_title = $item->title;
        if(file_exists(public_path().$old_title)){
            File::delete(public_path().$old_title);
        }
        $item->delete();
        return redirect('/home/productType');
    }

    public function ajax_delete_news_imgs(Request $request){
        $newsimgid = $request->newsimgid;
        $item = ProductType::find($newsimgid);
        $old_image = $item->img_url;

        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }
        $item->delete();

        return $newsimgid;
    }

    public function ajax_post_sort(Request $request){
        $news_img_id = $request->id;
        $sort = $request->sort;

        $img = ProductType::find($news_img_id);
        $img->sort = $sort;
        $img->save();
    }

    private function fileUpload($file, $dir)
    {
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/')) {
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if (!is_dir('upload/' . $dir)) {
            mkdir('upload/' . $dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time() . md5(rand(100, 200))) . '.' . $extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path() . '/upload/' . $dir . '/' . $filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/' . $dir . '/' . $filename;
    }
}
