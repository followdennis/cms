<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RawDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::connection('mysql_center')->table('rawdata')->insert([
            ['title'=>'文章标题7','content'=>'文章正文6','author'=>'作者6'],
            ['title'=>'文章标题7','content'=>'文章正文7','author'=>'作者7'],
        ]);
    }
}
