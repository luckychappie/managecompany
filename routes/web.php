<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();





/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
|
*/ 

Route::get('employees/export/', 'EmployeeController@export')->name('employees.export');
Route::group(['middleware'=>'auth:web','prefix'=>'admin'], function() {

    Route::get('/home', 'HomeController@index')->name('home');

  

    //---------- USER -----------
    Route::resource('users', 'UserController');

    //---------- Company -----------
    Route::resource('companies', 'CompanyController');

    //---------- Employee -----------
    Route::resource('employees', 'EmployeeController');


}); 
