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

use TsaiYiHua\ECPay\Checkout;

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

    public function product_detail($id){
        $Product = Products::find($id);
        return view ('front/product_detail',  compact('Product'));
    }

    public function add_cart($productId){

        $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
        $rowId = $productId; // generate a unique() row ID

        // add the product to cart
       \Cart::add(array(
            'id' => $rowId,
            'name' => $Product->title,
            'price' => $Product->price,
            'quantity' =>  1,
            'img' => $Product->img,
            'attributes' => array(),
            'associatedModel' => $Product
        ));

        return redirect('cart');
    }

    public function cart_total(){
        $items = \Cart::getContent();
        return view('front/cart', compact('items'));
    }

// 測試綠界金流
protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function test_check_out(){
        $formData = [
            'UserId' => 1, // 用戶ID , Optional
            'ItemDescription' => '產品簡介',
            'ItemName' => 'Product Name',
            'TotalAmount' => '2000',
            'PaymentMethod' => 'Credit', // ALL, Credit, ATM, WebATM
        ];
        return $this->checkout->setPostData($formData)->send();
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
