<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'customer.menu', ['category' => 'pizzas']);

Route::get('/menu/{category}', function($category) {
    return view('customer.menu', ['category' => $category]);
});

Route::view('/offers', 'customer.offers');
Route::view('/login', 'customer.auth.login');
Route::view('/cart', 'customer.cart');