<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InstituicaoTiposTableSeeder::class);
        $this->call(RegioesTableSeeder::class);
        $this->call(UfsTableSeeder::class);
        $this->call(TemasTableSeeder::class);
    }
}
