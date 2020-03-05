<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='news';

    protected $fillable = [
        'img', 'title', 'content','sort'
    ];

    // 建立關聯資料的功能至new_imgs(接下來news_detail要用這個function)
    public function news_imgs(){
        return $this->hasMany('App\News_Img');
    }
}
