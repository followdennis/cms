<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'123456@qq.com',
            'password'=>bcrypt('admin')
        ]);
    }
}
