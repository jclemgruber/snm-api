<?php

use Illuminate\Database\Seeder;

class InstituicaoTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\InstituicaoTipo::class, 10)->create();
    }
}
