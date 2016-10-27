<?php

use Illuminate\Database\Seeder;

class RegioesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Regiao::class, 5)->create();
    }
}
