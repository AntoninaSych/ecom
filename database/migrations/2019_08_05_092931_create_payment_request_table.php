<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment_id');
            $table->integer('from_status');
            $table->integer('to_status');
            $table->integer('user_request');
            $table->string('comment_request');
            $table->integer('user_response');
            $table->string('comment_response');
            $table->integer('is_applied')->default(0)->comment('0 - new, 1-allayed, 2-rejected');
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
        Schema::dropIfExists('payment_request');
    }
}
