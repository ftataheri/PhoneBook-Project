<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\UsersModel;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

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

//Route::get('/welcome', function () {
//    return view('welcome');
//});

//Auth::routes();

Route::get('/', function () {
    return view('login');
});

Route::get('/groups', function () {
    $groupSizes = [3, 3, 3, 3, 3, 1, 3];
    $size = 0;
    $group = [];
    $id = 0;
    $index = 0;
    $arrayAll = [];
    for ($i = 0; $i < count($groupSizes); $i++) {
        if ($groupSizes[$i] == '-') {
//            dd(123);
            continue;
        } else {
            $group = [];
            $len = $groupSizes[$i];
            for ($j = 0; $j < $len; $j++) {

                $index = array_search($len, $groupSizes);
                array_push($group, $index);
                $groupSizes[$index] = '-';
//                dd(array_search($len, $groupSizes));

            }
            array_push($arrayAll, $group);
//            dd($groupSizes,$arrayAll, $group,$groupSizes[$i] == '-');

        }
    }
//    dd($groupSizes);

    dd($arrayAll);
//    dd($arrayAll,$group);
});

Route::get('/login', function () {

    return redirect('/');
});


//Route::post('/doLogin', [UserController::class,'login']);
Route::post('/submit', [UserController::class, 'insert']);
Route::get('/delete/{id?}', [UserController::class, 'deleteUser'])->where('id', '(.*)');
Route::post('/infoUser', [UserController::class, 'infoUser']);
Route::post('/edit', [UserController::class, 'updateUser']);
Route::post('/updateUserView', [UserController::class, 'updateUserView']);
Route::any('/profile', [UserController::class, 'login']);
Route::get('/reload-captcha', [UserController::class, 'reloadCaptcha']);
//Route::post('/post',[UserController::class,'post']);
Route::get('/services', [UserController::class, 'services']);
Route::get('/services/{id?}', [UserController::class, 'more']);
Route::get('/details/{id?}', [UserController::class, 'selectedService']);
Route::get('/receipt/{id?}', [UserController::class, 'receipt']);
Route::any('/query', [UserController::class, 'query']);
//Route::any('/api',[UserController::class,'getRequest']);
Route::any('/api', [UserController::class, 'curlgetRequest']);
Route::get('/home', [UserController::class, 'viewAllUser']);


//Route::middleware([UserLogined::class])->group(function () {
//    Route::get('/home', [UserController::class,'viewAllUser']);
//
//});


//Route::view('/profile','profile');


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
