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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/nihao', function () {
    return 'nihao';
});

Route::post('/test',function () {
    return "nihao";
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

Route::get('/success', function () {
    return view('login/success',['username'=> 'admin','password'=> '123456','message' => 'testlogin']);
});



Route::get('/mylogin', function() {
    return view('login');
}) -> name('loginmain');

// Route::get('/loginerror',function () {
//     return view('login/error');
// }) -> name('loginerror');

use App\Http\Controllers\loginController;
use App\Http\Controllers\loginErrorController;

Route::post('/getform',[loginController::class,'show']);



Route::get('/loginlogin', function() {
    return view('login/login');
}) -> name('loginlogin');

Route::get('/loginerror', [loginErrorController::class, 'show']) -> name('loginerror');


Route::any('/logincheck', [loginController::class, 'show']
    // return view('login/success',['username'=> "12",'password'=> "123",'message' => "nihao"]);
    // return view('welcome');
);