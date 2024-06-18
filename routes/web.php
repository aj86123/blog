<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Support\Facades\Redis;
Route::get('/info',function () {

    Redis::select(2);
    Redis::set("username",'admin1');
    Redis::set('password','12345admin1');
    Redis::select(0);
    $value = Redis::get('sex');

    return $value;
});

use Illuminate\Http\Request;
Route::get('/url',function (Request $request) {
    return var_dump(array([
        $request -> url(),
        $request -> path(),
        $request -> getBaseUrl(),
        date('Y-m-d H:i:s'),
    ]));
});


use App\Http\Controllers\loginController;
use App\Http\Controllers\loginErrorController;

Route::get('/login', function() {
    return view('login/login');
}) -> name('login');

Route::get('/loginerror', [loginErrorController::class, 'show']) -> name('loginerror');

Route::any('/logincheck', [loginController::class, 'show']
);
