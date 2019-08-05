<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantInfoTable extends Migration
{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('merchant_info', function (Blueprint $table) {
//            //common
//            $table->increments('id');
//            $table->integer('merchant_id');
//            $table->foreign('merchant_id')->references('id')->on('merchants');
//
//            $table->string('name_retail_point_ukr',20)->nullable();
//            $table->string('name_retail_point_en',20)->nullable();
//            $table->string('category_description',255)->nullable();
//            $table->enum('personType',['ur', 'ind']);
//            ///----------------Физ  лицо--------/////
//            ///Данные контактного лица
//            $table->string('ind_contact_name',50)->nullable();
//            $table->string('ind_contact_phone',25)->nullable();
//            $table->string('ind_contact_email',50)->nullable();
//            //Данные физ особы
//            $table->string('ind_fio',100)->nullable();
//            $table->string('ind_inn',20)->nullable();
//            $table->date('ind_birthday')->nullable();
//            $table->string('ind_phone',20)->nullable();
//            $table->string('ind_email',30)->nullable();
//            $table->string('ind_main_rate',10)->nullable();
//            $table->string('ind_single_tax_rate',10)->nullable();
//
//            ///----------------Юридическое лицо--------/////
//            $table->string('ur_retail_name_ukr',100)->nullable();
//            $table->string('ur_retail_name_en',100)->nullable();
//
//            $table->string('ur_city',20)->nullable();
//            $table->string('ur_address',100)->nullable();
//             $table->string('ur_region',100)->nullable();
//            //Данные директора юридической особы
//            $table->string('ur_fio',50)->nullable();
//            $table->string('ur_inn',20)->nullable();
//            $table->date('ur_birthday')->nullable();
//            $table->string('ur_phone',20)->nullable();
//            $table->string('ur_email',50)->nullable();
//            //Данные контактного лица
//            $table->string('ur_contact_fio',100)->nullable();
//            $table->string('ur_contact_phone',20)->nullable();
//            $table->string('ur_contact_email',30)->nullable();
//
//            //Фактична адреса ведення бізнесу:
//
//            $table->string('ur_actual_business_address',100)->nullable();
//            $table->string('ur_actual_business_city',20)->nullable();
//            $table->string('ur_actual_business_region',30)->nullable();
//            $table->string('ur_actual_business_index',30)->nullable();
//            $table->string('ur_type',255)->nullable();
//            $table->string('ur_data_controllers',255)->nullable();
//            //Дані бухгалтера (за наявністю)
//            $table->string('ur_buh_fio',255)->nullable();
//            $table->string('ur_buh_phone',255)->nullable();
//            $table->string('ur_buh_email',255)->nullable();
//
//            $table->timestamp('created_at')->useCurrent();
//            $table->timestamp('updated_at')
//                ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
//
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
//        Schema::dropIfExists('merchant_info');
//    }
}
