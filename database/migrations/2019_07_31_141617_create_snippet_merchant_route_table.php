<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnippetMerchantRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('snippet_merchant_route', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_route_id');
            $table->integer('sum_min');
            $table->integer('sum_max');
            $table->integer('card_system');
            $table->integer('bins');
            $table->tinyInteger('final')->default(0)->comment('1-final, 0-not final');
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
        Schema::dropIfExists('snippet_merchant_route');
    }
}
