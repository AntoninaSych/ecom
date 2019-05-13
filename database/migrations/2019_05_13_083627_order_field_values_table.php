<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderFieldValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_fields_values', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('field_id')->unsigned();
            $table->foreign('field_id')->references('id')->on('order_field');


            $table->integer('field_value');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('order');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_fields_values');
    }
}
