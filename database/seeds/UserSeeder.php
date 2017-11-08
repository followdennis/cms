<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dogs = factory(\App\Dog::class)->times(100)->make();
        \App\Dog::insert($dogs->toArray());


    }
}
