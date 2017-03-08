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

/*
 * define 方法定义了一个指定数据模型（如此例子 User）的模型工厂。
 * 该方法接收两个参数，
 * 第一个参数为指定的 Eloquent 模型类，
 * 第二个参数为一个闭包函数，该闭包函数接收一个 Faker PHP 函数库的实例，
 * 让我们可以在函数内部使用 Faker 方法来生成假数据并为模型的指定字段赋值。
 *
 * 可以在该文件中同时定义多个模型工厂。
 */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
//        'password' => bcrypt(str_random(10)),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
        'is_admin' => false,
    ];
});
