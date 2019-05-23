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
            $table->string('ind_contact_name',100)->nullable();
            $table->string('ind_contact_inn',20)->nullable();
            $table->date('ind_contact_birthday')->nullable();
            $table->string('ind_contact_email',30)->nullable();
            $table->string('ind_contact_retail_name',100)->nullable();
            $table->string('ind_contact_city',100)->nullable();
            $table->string('ind_contact_address',100)->nullable();
            $table->string('ind_contact_region',100)->nullable();
            $table->string('ind_contact_phone',100)->nullable();
            $table->string('ind_contact_mail_index',100)->nullable();
            $table->tinyInteger('ind_is_director')->nullable();
            $table->string('ind_fio',100)->nullable();
            $table->string('ind_inn',20)->nullable();
            $table->date('ind_birthday')->nullable();
            $table->string('ind_phone',20)->nullable();
            $table->string('ind_email',30)->nullable();
            $table->string('ur_retail_name',100)->nullable();
            $table->string('ur_city',20)->nullable();
            $table->string('ur_address',100)->nullable();
             $table->string('ur_region',100)->nullable();
            $table->string('ur_mail_index',100)->nullable();
            $table->string('ur_fio',50)->nullable();
            $table->string('ur_inn',20)->nullable();
            $table->date('ur_birthday')->nullable();
            $table->string('ur_phone',20)->nullable();
            $table->string('ur_email',30)->nullable();
            $table->string('ur_fio_contact',100)->nullable();
            $table->string('ur_phone_contact',20)->nullable();
            $table->string('ur_email_contact',30)->nullable();
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
