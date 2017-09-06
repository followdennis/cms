<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //如果表不存在
        if(!Schema::hasTable('chefs')){
            Schema::create('chefs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('chef_name');
                $table->smallInteger('like_num');
                $table->string('content')->nullable();
                $table->smallInteger('click')->unsigned()->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chefs');
    }
}
