<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltrerMccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mcc_code', function (Blueprint $table) {
            //
            $table->text('name_uk')->nullable();
            $table->text('name_en')->nullable();
            $table->text('description')->nullable();
            $table->integer('hight_risk')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mcc_code', function (Blueprint $table) {
            $table->dropColumn('name_uk');
            $table->dropColumn('name_en');
            $table->dropColumn('description');
            $table->dropColumn('hight_risk');
        });
    }


}
