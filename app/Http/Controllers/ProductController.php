<?php

namespace App\Http\Controllers;

use App\Products;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $all_products = Products::all();
        return view('auth/admin/product/index', compact('all_products'));
    }

    // 新增並儲存至SQL database
    // 1. 先連到對應的新增介面
    public function create()
    {
        $productTypes = ProductType::all();
        return view('auth/admin/product/create', compact('productTypes'));
    }
    // 2. 再儲存新增的資料
    public function store(Request $request)
    {
        $products_data = $request->all();

        //上傳檔案
        if($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $this->fileUpload($file,'products');
            $products_data['img'] = $path;
        }
        // ------------------------------------------

        // 變成多張圖上傳改寫
        $new_products = Products::create($products_data);

        if ($request->hasFile('news_imgs')) {
            $files = $request->file('news_imgs');
            foreach ($files as $file) {
                // 上傳圖片
                $path = $this->fileUpload($file, 'products');
                //建立News多張圖片的資料
                $products_imgs = new Products;
                $products_imgs->news_id = $new_products->id;
                $products_imgs->img_url = $path;
                $products_imgs->save();
            }
        }
        return redirect('/home/product');
    }


    // 可針對特定項目做修改
    // 1. 先抓到對應的id
    public function edit($id)
    {
        // 寫法1
        $productTypes= ProductType::all();
        $products = Products::find($id);
        return view('auth/admin/product/edit', compact('productTypes','products'));
    }
    // 2. 再將修改的內容更新上去
    public function update(Request $request, $id)
    {
       // ------寫法4 暴力破解------
       $request_data = $request->all();
       $products = Products::find($id);

       // 如果有上傳新圖片
       if ($request->hasFile('img')) {
           // 舊圖片刪除
           $old_image = $item->img;
           File::delete(public_path().$old_image);

           // 上傳新圖片
           $file = $request->file('img');
           $path = $this->fileUpload($file, 'products');
           $request_data['img'] = $path;
       }


       $products->update($request_data);
       return redirect('/home/product');
    }


    public function delete(Request $request, $id)
    {
        $item = Products::find($id);
        $old_image = $item->img;
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }
        $item->delete();
        return redirect('/home/product');
    }

    public function ajax_delete_news_imgs(Request $request){
        $newsimgid = $request->newsimgid;
        $item = Products::find($newsimgid);
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

        $img = Products::find($news_img_id);
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
