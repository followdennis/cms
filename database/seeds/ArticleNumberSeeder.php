<?php

use Illuminate\Database\Seeder;


class ArticleNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //填充500万条数据
        $data = [];
        for($i = 1 ; $i< 5000; $i++){
            $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            array_push($data,[
                'cate_id'=>mt_rand(1,10),
                'created_at'=>$now
            ]);
            if($i % 1000 == 0){
                \DB::beginTransaction();
               \DB::table('article_number')->insert($data);
               \DB::commit();
                $data = [];
            }
        }
    }
}
