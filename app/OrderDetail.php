<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $order_id
 * @property string $product_id
 * @property int $qty
 * @property int $price
 * @property string $created_at
 * @property string $updated_at
 */
class OrderDetail extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'order_detail';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'qty', 'price', 'created_at', 'updated_at'];

}
