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
        'inicio_inscricoes' => $faker->date('Y-m-d\TH:i:s.u\Z'),
        'fim_inscricoes' => $faker->date('Y-m-d\TH:i:s.u\Z'),
        'inicio_evento' => $faker->date('Y-m-d\TH:i:s.u\Z'),
        'fim_evento' => $faker->date('Y-m-d\TH:i:s.u\Z'),
        'antes_inscricoes' => $faker->text,
        'apos_inscricoes' => $faker->text
    ];
});

$factory->define(App\Model\EnderecoTipo::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->word
    ];
});

$factory->define(App\Model\Museu::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->sentence,
        'site' => $faker->url,
        'email' => $faker->email,
        'instituicao_tipo_id' => $faker->randomDigitNotNull,
        'user_id' => $faker->numberBetween(1,20),
        'fone1' => $faker->phoneNumber,
        'fone2' => $faker->phoneNumber
    ];
});

$factory->define(App\Model\MuseuEndereco::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'endereco_tipo_id' => 1,
        'cidade_id' => $faker->numberBetween(1,20),
        'logradouro' => $faker->streetName,
        'numero' => $faker->buildingNumber,
        'cep' => $faker->postCode,
        'bairro' => $faker->cityPrefix,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});

$factory->define(App\Model\EventoTipo::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'nome' => $faker->word
    ];
});

$factory->define(App\Model\Evento::class, function ($faker) {
    $faker = Faker::create('pt_BR');
    return [
        'descricao' => $faker->paragraph(),
        'museu_id' => $faker->numberBetween(1,20),
        'tema_id' => $faker->numberBetween(1,5),
        'evento_tipo_id' => $faker->numberBetween(1,5),
        'inicio_evento' => $faker->date('Y-m-d'),
        'fim_evento' => $faker->date('Y-m-d'),
        'hora_inicio_evento' => $faker->time('H:i'),
        'hora_fim_evento' => $faker->time('H:i'),
        'local' => $faker->address,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude
    ];
});
