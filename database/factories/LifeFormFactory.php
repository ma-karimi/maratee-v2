<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\LifeForm;
use Faker\Generator as Faker;

$factory->define(LifeForm::class, function (Faker $faker) {


    return [
      'name'=>make_json($faker->word),
      'type'=>'',
    ];
});
