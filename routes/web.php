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

// Route::get('/', function () {
//     return view('layout.app');
// });
Route::get('/config-view-clear-cache', function() {
    $a = Artisan::call('config:cache');
    $b = Artisan::call('config:clear');
    $c = Artisan::call('view:cache');
    $d = Artisan::call('view:clear');
    return "Configuration cache cleared! Configuration cached successfully! Compiled views cleared! Blade templates cached successfully!";
});
Route::get('/command-storage-link', function() {
    $a = Artisan::call('storage:link');
    return $a;
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/detail/{id}', 'HomeController@detail')->name('detail');
    
    Route::group(['middleware' => ['role:Super User'],'prefix' => 'table'], function () {
        Route::get('data-home', 'HomeController@getData');
    });
    
    Route::get('/', function(){
        if (Auth::user()->hasAnyRole(['Super User'])) {
            return redirect()->route('home');
        } else {
            Auth::logout();
            return redirect()->route('login');
        }
    });
});
Auth::routes();