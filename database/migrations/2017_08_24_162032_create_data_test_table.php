<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_test', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('num')->unsigned()->default(0);
            $table->string('name',20)->nullable()->comment('名称');
            $table->string('cate',20)->nullable();
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
        Schema::dropIfExists('data_test');
    }
}
