<?php

use Illuminate\Database\Seeder;

class StringLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('string_level')->truncate();
        $data = [];
        for($i= 0; $i < 10; $i++){
            array_push($data,[
                'id'=>str_pad(rand(0,20),2,"0",STR_PAD_LEFT),
                'parent'=>'0',
                'name'=>str_random(10),
            ]);
        }
        for($i= 0; $i < 100; $i++){
            array_push($data,[
                'id'=>str_pad(rand(0,20),2,"0",STR_PAD_LEFT).str_pad(rand(0,99),2,"0",STR_PAD_LEFT),
                'parent'=>str_pad(rand(0,20),2,"0",STR_PAD_LEFT),
                'name'=>str_random(10),
            ]);
        }
        \DB::table('string_level')->insert($data);
        echo 'ok';
    }
}
