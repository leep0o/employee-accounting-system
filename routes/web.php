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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    // company
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('/company/store', 'CompanyController@storeCompany')->name('storeCompany');
    Route::post('/company/delete', 'CompanyController@deleteCompany')->name('deleteCompany');

    // employee
    Route::get('/company/add-employee', 'CompanyController@addEmployee')->name('addEmployee');
    Route::get('/company/edit-employee/{id}', 'CompanyController@editEmployee')->name('editEmployee');
    Route::post('/company/store-employee', 'CompanyController@storeEmployee')->name('storeEmployee');
    Route::post('/company/delete-employee', 'CompanyController@deleteEmployee')->name('deleteEmployee');

    // add comment
    Route::post('/company/add-comment', 'CompanyController@addComment')->name('addComment');
});

Route::get('/', 'CompanyController@companyList');
Route::get('/company/{id}', 'CompanyController@showCompany')->name('company');
