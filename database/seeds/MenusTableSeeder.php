<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Illuminate\Support\Facades\DB::table('menus')->insert([
            'pid'=>8,
            'catename'=>'三级分类（1）',
            'description'=>'三级分类',
            'created_at'=>\Carbon\Carbon::now(),
        ]);

    }
}
