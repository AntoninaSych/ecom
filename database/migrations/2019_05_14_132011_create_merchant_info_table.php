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
            $table->enum('merchant_type',['ur', 'ind']);

            $table->string('ur_name',100);
            $table->string('ur_city',20);
            $table->string('ur_address',100);
            $table->string('ur_region',100);
            $table->string('ur_index',100);

            $table->string('ur_director_fio',100);
            $table->string('ur_director_inn',100);
            $table->date('ur_director_birthday');
            $table->string('ur_director_phone',20);
            $table->string('ur_director_email',50);

            $table->string('ur_contact_person_name',50);
            $table->string('ur_contact_person_email',50);
            $table->string('ur_contact_person_phone',50);

            $table->string('ind_name',100);
            $table->string('ind_inn',100);
            $table->date('ind_birthday');
            $table->string('ind_phone',20);
            $table->string('ind_email',50);
            $table->string('ind_city',100);
            $table->string('ind_region',100);
            $table->string('ind_index',100);
            $table->boolean('ind_me')->default(true);
            $table->string('ind_director_name',100);
            $table->string('ind_director_inn',100);
            $table->string('ind_director_birthday',100);
            $table->string('ind_director_phone',100);
            $table->string('ind_director_email',50);


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
