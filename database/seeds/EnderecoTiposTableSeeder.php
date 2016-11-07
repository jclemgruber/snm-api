<?php

use Illuminate\Database\Seeder;

class EnderecoTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\EnderecoTipo::class, 1)->create();
    }
}
