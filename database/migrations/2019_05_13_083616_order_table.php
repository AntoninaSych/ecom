<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderTable extends Migration
{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('order', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->integer('user_id');
//            $table->integer('merchant_id');
//
//            $table->integer('order_status')->unsigned()->default(1);
//            $table->foreign('order_status')->references('id')->on('ref_order_status');
//
//            $table->integer('security_check')->unsigned()->nullable();
//            $table->string('security_comment',255)->nullable();
//
//
//            $table->integer('fraud_check')->unsigned()->nullable();
//            $table->string('fraud_comment',255)->nullable();
//
//            $table->integer('business_check')->unsigned()->nullable();
//            $table->string('business_comment',255)->nullable();
//
//            $table->foreign('security_check')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('fraud_check')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//            $table->foreign('business_check')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//
//
//            $table->integer('assigned')->unsigned()->nullable();
//            $table->foreign('assigned')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//
//            $table->integer('apply_user_id')->unsigned()->nullable();
//            $table->foreign('apply_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//
//            $table->integer('decline_user_id')->unsigned()->nullable();
//            $table->foreign('decline_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
//            $table->string('decline_comment',255)->nullable();
//
//            $table->integer('canceled')->nullable();
//
//
//            $table->timestamp('created_at')->useCurrent();
//            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//            $table->softDeletes();
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::dropIfExists('order');
//
//    }
}
