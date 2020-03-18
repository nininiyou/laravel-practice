<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('user_id');
            $table->text('recipient_name');
            $table->text('recipient_phone');
            $table->longText('recipient_add')->default('TEXT');
            $table->text('shipment_time');
            $table->integer('total_price')->default(0);
            $table->text('shipment_status');
            $table->text('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
