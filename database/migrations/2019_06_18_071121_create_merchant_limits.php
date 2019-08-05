<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantLimits extends Migration
{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('merchant_limits', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('merchant_id');
//            $table->foreign('merchant_id')->references('id')->on('merchants');
//            $table->string('amount');
//            $table->integer('card_system');
//            $table->foreign('card_system')->references('id')->on('cards_systems');
//            $table->integer('limit_types')->unsigned();
//            $table->foreign('limit_types')->references('id')->on('ref_limit_types');
//            $table->timestamp('created_at')->useCurrent();
//            $table->timestamp('updated_at')
//                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//            $table->unique(['merchant_id', 'limit_types','card_system']);
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
//        Schema::dropIfExists('merchant_limits');
//    }
}
