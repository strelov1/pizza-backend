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

use Illuminate\Support\Str;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->safeColorName,
    ];
});
$factory->define(App\Models\Image::class, function (Faker\Generator $faker) {
    return [
        'src' => '/img/'.random_int(1, 10).'.jpg',
    ];
});

$factory->define(App\Models\Token::class, function (Faker\Generator $faker) {
    return [
        'token' => Str::random(32),
    ];
});

$dict = [
    'Cheese',
    'Hot',
    'Pepper',
    'Garlic',
    'Mushroom',
    'Piperony',
    'Margherita',
    'Tomato',
    'sauce',
    'mozzarella',
    'oregano',
    'Marinara',
    'garlic',
    'basil',
    'Quattro',
    'Stagioni',
    'mushrooms',
    'ham',
    'artichokes',
    'olives',
    'Carbonara',
    'parmesan',
    'eggs',
    'bacon',
    'Frutti',
    'di',
    'Mare',
    'seafood',
    'Formaggi',
    'gorgonzola',
    'cheese',
    'Crudo',
    'Parma',
    'Napoletana',
    'or',
    'Napoli',
    'anchovies',
    'Pugliese',
    'onions',
    'Montanara',
    'pepperoni',
    'Stracchino',
    'cheese)',
    'Emiliana',
    'eggplant',
    'boiled',
    'potatoes',
    'sausage',
    'Romana',
    'capers',
    'Fattoria',
    'peppers',
    'peas',
    'porchetta',
    'Italian',
    'spit-roasted',
    'Schiacciata',
    'Olive',
    'oil',
    'rosemary',
    'Prosciutto',
    'Cardinale',
    'Americana',
    'french',
    'fries',
    'Funghi',
    'Braccio',
    'Ferro',
    'Mozzarella',
    'spinach',
    'ricotta',
    'Sarda',
    'pecorino',
    'spicy',
    'salami',
    'Tonno',
    'tuna',
    'Valtellina',
    'bresaola',
    'Parmesan',
    'flakes',
    'rocket',
    'Gorgonzola',
    'Calzone',
    'Pizza',
    'Pesto',
    'Genoese',
    'pesto',
    'pine',
    'nuts',
    'Mediterranea',
    'buffalo',
    'cherry',
    'tomatoes',
    'pepper',
    'Ortolana',
    'assorted',
    'vegetables',
    'Diavola',
    'chilli',
    'Rustica',
    'eggplants',
    'Contadina',
    'asparagus',
    'Parmigiana',
    'Capricciosa',
    'Ricotta',
    'Spinaci',
    'Monti',
    'tomato',
    'porcino',
    'Padana',
    'zucchini',
    'polenta',
    'Tedesca',
    'Vienna',
    'Sausage',
    'Tirolese',
    'speck',
    'Boscaiola',
    'Campagnola',
    'corn',
    'Vegetariana',
    'various',
    'vegetable',
    'Bufalina',
    'Buffalo',
    'Fontana',
    'radicchio',
    'Francescana',
    'tartufata',
    'truffle',
    'cream',
    'porcini',
    'Tricolore',
    'Valdostana',
    'fontina',
    'Caprese',
    'sliced',
    '​​tomato',
    'Fiori',
    'zucca',
    'courgette',
    'flower',
    'olive',
    'Bismarck',
    'fried',
    'egg',
    'parsley',
    'Mimosa',
];

$factory->define(App\Models\Product::class, function (Faker\Generator $faker) use ($dict) {
    $price = $faker->randomFloat(2, 4, 25);

    return [
        'name' => 'Pizza '.ucfirst($dict[array_rand($dict)]),
        'description' => 'Pizza '.$faker->safeColorName,
        'price_usd' => $price,
        'price_eur' => $price + 0.10,
        'category_id' => function () {
            return factory(\App\Models\Category::class)->create()->id;
        },
        'image_id' => function () {
            return factory(\App\Models\Image::class)->create()->id;
        },
    ];
});
