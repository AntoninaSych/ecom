<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_info', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
             $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->enum('personType',['ur', 'ind']);
            $table->string('ind_contact_name',100);
            $table->string('ind_contact_inn',20);
            $table->date('ind_contact_birthday');
            $table->string('ind_contact_email',30);
            $table->string('ind_contact_retail_name',100);
            $table->string('ind_contact_city',100);
            $table->string('ind_contact_address',100);
            $table->string('ind_contact_region',100);
            $table->string('ind_contact_phone',100);
            $table->string('ind_contact_mail_index',100);
            $table->tinyInteger('ind_is_director');
            $table->string('ind_fio',100);
            $table->string('ind_inn',20);
            $table->date('ind_birthday');
            $table->string('ind_phone',20);
            $table->string('ind_email',30);
            $table->string('ur_retail_name',100);
            $table->string('ur_city',20);
            $table->string('ur_address',100);
             $table->string('ur_region',100);
            $table->string('ur_mail_index',100);
            $table->string('ur_fio',50);
            $table->string('ur_inn',20);
            $table->date('ur_birthday');
            $table->string('ur_phone',20);
            $table->string('ur_email',30);
            $table->string('ur_fio_contact',100);
            $table->string('ur_phone_contact',20);
            $table->string('ur_email_contact',30);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merchant_info');
    }
}
