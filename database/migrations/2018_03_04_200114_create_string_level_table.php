<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStringLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('string_level', function (Blueprint $table) {
            $table->string('id',8);
            $table->string('name')->nullable()->comment('名称');
            $table->string('parent',8)->nullable()->comment('父id');
            $table->integer('click')->default(0)->comment('数字');
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
        Schema::dropIfExists('string_level');
    }
}
