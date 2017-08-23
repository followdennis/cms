<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLizhiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('lizhi')){
            Schema::create('lizhi', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name',50)->comment('名称');
                $table->string('title',255)->comment('标题');
                $table->text('content')->nullable()->comment('文章内容');
                $table->smallInteger('click')->default(0);
                $table->string('cate',20)->nullable()->comment('分类');
                $table->softDeletes();
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
        Schema::dropIfExists('lizhi');
    }
}
