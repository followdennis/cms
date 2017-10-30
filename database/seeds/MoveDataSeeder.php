<?php

use Illuminate\Database\Seeder;

class MoveDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $select_status = \DB::connection('mysql_center')->table('renshengzhinan')->orderBy('id','asc')->chunk(1000,function($reshengzhinan){
            $data = [];
            $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            foreach($reshengzhinan as $k => $v){
                array_push($data,[
                    'name'=>str_random(10),
                    'title'=>$v->title,
                    'content'=>$v->content,
                    'created_at'=>$now
                ]);
            }
            $status = \DB::table('lizhi_2')->insert($data);
            if($status){
                info('success'.$k);
            }
        });

    }
}
