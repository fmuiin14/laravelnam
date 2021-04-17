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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('employee-edit');
Route::post('/employee-store', 'EmployeeController@store')->name('employee-store');
Route::get('/employee/destroy/{id}', 'EmployeeController@destroy')->name('employee-destroy');
Route::get('/employee-create', 'EmployeeController@create')->name('employee-create');

// Route::get('admin-page', )->middleware('role:admin')->name('admin.page');

// Route::get('user-page', function() {
//     return 'Halaman untuk User';
// })->middleware('role:finance')->name('finance.page');

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();