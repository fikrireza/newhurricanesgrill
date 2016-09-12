<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('front/index');
});


Route::get('hurricanesmenu/dahsboard', 'DashboardController@index')->name('dashboard');


// Account Management //
Route::get('hurricanesmenu/account-management', 'AccountManagementController@index')->name('account');
Route::post('hurricanesmenu/account-create', 'AccountManagementController@store')->name('account.create');


// Branch Management //
Route::get('hurricanesmenu/branch-management', 'BranchController@index')->name('branch');
Route::get('hurricanesmenu/branch-create', 'BranchController@create')->name('branch.view');
Route::post('hurricanesmenu/branch-create', 'BranchController@store')->name('branch.create');
Route::get('hurricanesmenu/branch-bind/{id}', 'BranchController@bind')->name('branch.bind');
Route::post('hurricanesmenu/branch-update', 'BranchController@update')->name('branch.update');
Route::get('hurricanesmenu/branch-nonactive/{id}', 'BranchController@nonactive');
Route::get('hurricanesmenu/branch-active/{id}', 'BranchController@active');


// For Auth //
Route::auth();
