<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';

    protected $fillable = [
        'type_id', 'img','title', 'content','price', 'quantity', 'sort'
    ];

    public function product_type(){
        return $this->belongsTo('App\ProductType', 'type_id');
    }

}
