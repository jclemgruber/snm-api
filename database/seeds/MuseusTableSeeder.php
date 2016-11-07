<?php

use Illuminate\Database\Seeder;

class MuseusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Museu::class, 30)->create()->each(function($museu){
            factory(App\Model\MuseuEndereco::class, 1)->create(['museu_id'=>$museu->id]);
        });
    }
}
