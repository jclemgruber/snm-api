<?php

use Illuminate\Database\Seeder;

class UfsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Uf::class, 20)->create()->each(function($uf){
            factory(App\Model\Cidade::class, 30)->create(['uf_id'=>$uf->id]);
        });
    }
}
