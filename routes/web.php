<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/report-form-submit', 'HomeController@reportFormSubmit')->name('report.form.submit');
Route::get('/report/edit/{report_id}', 'HomeController@report_edit')->name('report.edit');
Route::post('/report/store', 'HomeController@report_update')->name('report.update');
