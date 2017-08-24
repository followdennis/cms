<?php

use Illuminate\Database\Seeder;

class DataTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($j = 0; $j < 10; $j++){
            for($i = 0 ; $i < 10; $i++){

                \DB::table('data_test')->insert([
                    'name'=>str_random(10),
                    'num' => rand(100,1000),
                    'cate'=>$j+1
            ]);

        }
        }


    }
}
