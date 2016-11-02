<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use Faker\Factory as Faker;

$factory->define(App\User::class, function ($faker) {
    static $password;

    $faker = Faker::create('pt_BR');
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'cpf' => $faker->randomNumber(6),
        'login_type' => 'normal'
    ];
});

$factory->define(App\Model\InstituicaoTipo::class, function ($faker) {
	$faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->word,
    ];
});

$factory->define(App\Model\Regiao::class, function ($faker) {
	$faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->word,
    ];
});

$factory->define(App\Model\Uf::class, function ($faker) {
	$faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->state,
        'abrev' => $faker->stateAbbr,
        'regiao_id' => $faker->numberBetween(1,5),
    ];
});

$factory->define(App\Model\Cidade::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->city,
    ];
});

$factory->define(App\Model\Tema::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->sentence,
        'ativo' => false,
        'inicio_inscricoes' => $faker->date,
        'fim_inscricoes' => $faker->date,
        'inicio_evento' => $faker->date,
        'fim_evento' => $faker->date,
        'antes_inscricoes' => $faker->text,
        'apos_inscricoes' => $faker->text
    ];
});
