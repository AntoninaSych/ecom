<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogMerchantRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('log_merchant_requests', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->integer('back_user_id')->unsigned();
//            $table->foreign('back_user_id')->references('id')->on('users')
//                ->onUpdate('cascade')->onDelete('cascade');
//
//
//            $table->integer('front_user_id')->unsigned();
//
//
//
//            $table->integer('merchant_id');
//            $table->foreign('merchant_id')->references('id')->on('merchants');
//
//            $table->integer('order_id');
//            $table->foreign('order_id')->references('id')->on('order');
//
//
//
//            $table->timestamp('created_at')->useCurrent();
//            $table->timestamp('updated_at')
//                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     //   Schema::dropIfExists('log_merchant_requests');
    }
}
