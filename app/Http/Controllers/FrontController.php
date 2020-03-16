<?php

namespace App\Http\Controllers;

use App\News;
use App\Products;
use App\ContactUs;
use App\Mail\OrderShipped;
use App\ProductType;

use App\Mail\SendToUser;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        // $item = News::find($id);
        $item = News::with('news_imgs')->find($id);
        return view('front/news_detail', compact('item'));

    }

    // -----產品資訊 & 產品購物車-----
    public function product(){
        $products_d = Products::orderBy('sort','DESC')->get();
        return view ('front/product', compact('products_d'));
    }

    public function product_detail(){
        return view ('front/product_detail');
    }

    public function add_cart(){
        $id = 2;
        $Product = Products::find($id); // assuming you have a Product model with id, name, description & price
        $rowId = 456; // generate a unique() row ID
        $userID = Auth::user()->id; // the user ID to bind the cart contents

        // add the product to cart
        \Cart::session($userID)->add(array(
            'id' => $rowId,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' => 4,
            'attributes' => array(),
            'associatedModel' => $Product
        ));
    }

    public function cart_total(){
        $userID = Auth::user()->id; // the user ID to bind the cart contents
        $items = \Cart::session($userID)->getContent();
        return view('front/cart', compact('items'));
    }




    public function contact(){
        return view ('front/contact_me');

    }

    public function contact_store(Request $request){
        $user_data = $request->all();
        $content = ContactUs::create($user_data);

        Mail::to('nininiyou@gmail.com')->send(new OrderShipped($content));

        return redirect ('/contact');
    }



}
