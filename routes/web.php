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
    return view('home');
});

//Route::get('/admin/login', 'Backpack\CRUD\app\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::get('/dashboard', 'App\Http\Controllers\PageController@dashboard')->name('dashboard');
Route::get('/myaccount', 'App\Http\Controllers\MyAccountController@index')->name('myaccount');

// myaccount
Route::get('edit-account-info', 'App\Http\Controllers\MyAccountController@getAccountInfoForm')->name('myaccount.account.info');
Route::post('edit-account-info', 'App\Http\Controllers\MyAccountController@postAccountInfoForm')->name('myaccount.account.info.store');
Route::post('change-password', 'App\Http\Controllers\MyAccountController@postChangePasswordForm')->name('myaccount.account.password');

/** CATCH-ALL ROUTE for Backpack/PageManager - needs to be at the end of your routes.php file  **/
Route::get('{page}/{subs?}', ['uses' => '\App\Http\Controllers\PageController@index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);
