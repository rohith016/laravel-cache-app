<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;


Route::get('/active-users', function () {

    Redis::set("test", "Hdfasflsdf");


    // Redis::del("test");
    $data = Redis::get("testss") ?? "now cache key exist";

    dd($data);
    // $data = Cache::put('key', 'value', 6000);
    // $usersAll = Cache::remember('active_users', 60, function () {
        // return [
        //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
        //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
        //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
        //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
        //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
        // ];
    // });

    
    // dd(env('CACHE_DRIVER'));

    // Redis::put('users', [
    //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
    //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
    //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
    //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
    //     ["name" => "rohith", "email" => "rohith@email.com", "password" => "12345"],
    // ]);

    // Redis::forget('users');

    // if (Redis::has('users')) {
    //     return Redis::get('users');
    // } else {
    //     return 'no items in the cache';
    // }

    

});



// Route::get('/', function () {
//     return view('welcome');
// });
