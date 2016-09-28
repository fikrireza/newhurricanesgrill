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

Route::get('/', 'WebReservationController@home')->name('home');

Route::get('reservation', 'WebReservationController@index')->name('web.reservation');
Route::get('reservation-group', 'WebReservationController@groupbook')->name('groupbook');
Route::post('reservation', 'WebReservationController@store')->name('web.store');
Route::get('payment-confirm/{booking_code}', 'WebReservationController@confirmpayment')->name('web.confirmpayment');
Route::post('payment-confirm', 'WebReservationController@confirm')->name('web.confirm');


Route::get('/hurricanesmenu', 'Auth\AuthController@index')->name('index');

Route::get('hurricanesmenu/dashboard', 'DashboardController@index')->name('dashboard');


// Account Management //
Route::get('hurricanesmenu/account-management', 'AccountManagementController@index')->name('account');
Route::post('hurricanesmenu/account-create', 'AccountManagementController@create')->name('account.create');
Route::post('hurricanesmenu/account-update', 'AccountManagementController@update')->name('account.update');
Route::get('hurricanesmenu/verify/{code}', 'AccountManagementController@verify')->name('account.verify');
Route::post('hurricanesmenu/setpassword', 'AccountManagementController@setpassword')->name('setpassword');
Route::get('hurricanesmenu/account-bind/{id}', 'AccountManagementController@bind')->name('account.bind');
Route::get('hurricanesmenu/account-resend/{id}', 'AccountManagementController@resend');
Route::get('hurricanesmenu/account-disable/{id}', 'AccountManagementController@disable');
Route::get('hurricanesmenu/account-active/{id}', 'AccountManagementController@active');

Route::get('hurricanesmenu/profile', 'AccountManagementController@profile')->name('profile');
Route::post('hurricanesmenu/profile-update', 'AccountManagementController@profileUpdate')->name('profile.update');
Route::post('hurricanesmenu/profile-changePassord', 'AccountManagementController@changePassword')->name('profile.changePassword');

// Branch Management //
Route::get('hurricanesmenu/branch-management', 'BranchController@index')->name('branch');
Route::get('hurricanesmenu/branch-create', 'BranchController@create')->name('branch.view');
Route::post('hurricanesmenu/branch-create', 'BranchController@store')->name('branch.create');
Route::get('hurricanesmenu/branch-bind/{id}', 'BranchController@bind')->name('branch.bind');
Route::post('hurricanesmenu/branch-update', 'BranchController@update')->name('branch.update');
Route::get('hurricanesmenu/branch-nonactive/{id}', 'BranchController@nonactive');
Route::get('hurricanesmenu/branch-active/{id}', 'BranchController@active');

// Reservation Management //
Route::get('hurricanesmenu/reservation-management', 'ReservationController@index')->name('reservation');
Route::get('hurricanesmenu/reservation-create', 'ReservationController@create')->name('reservation.create');
Route::post('hurricanesmenu/reservation-store', 'ReservationController@store')->name('reservation.store');
Route::get('hurricanesmenu/reservation-bind/{id}', 'ReservationController@bind')->name('reservation.bind');
Route::post('hurricanesmenu/reservation-update', 'ReservationController@update')->name('reservation.update');
Route::get('hurricanesmenu/reservation-cancelled/{id}', 'ReservationController@cancelled')->name('reservation.cancelled');
Route::get('hurricanesmenu/reservation-cancel', 'ReservationController@cancel')->name('reservation.cancel');
Route::get('hurricanesmenu/reservation-accept/{id}', 'ReservationController@accept')->name('reservation.accept');
Route::post('hurricanesmenu/reservation-search/', 'ReservationController@search')->name('reservation.search');
Route::get('hurricanesmenu/reservation-block', 'ReservationController@block')->name('reservation.block');
Route::post('hurricanesmenu/reservation-block', 'ReservationController@blockreservation')->name('reservation.blockcreate');
Route::get('hurricanesmenu/reservation-blockbind/{id}', 'ReservationController@blockbind')->name('reservation.blockbind');
Route::post('hurricanesmenu/reservation-blockedit', 'ReservationController@blockedit')->name('reservation.blockedit');
Route::get('hurricanesmenu/reservation-payment', 'ReservationController@payment')->name('reservation.payment');
Route::post('hurricanesmenu/reservation-payment', 'ReservationController@paymentSearch')->name('reservation.paymentsearch');


// Menus Management //
Route::get('hurricanesmenu/menu-category', 'MenuController@category')->name('menu.category');
Route::post('hurricanesmenu/menu-categorycreate', 'MenuController@categoryCreate')->name('menu.categoryCreate');
Route::get('hurricanesmenu/menu-categorybind/{id}', 'MenuController@categoryBind');
Route::post('hurricanesmenu/menu-categoryupdate', 'MenuController@categoryUpdate')->name('menu.categoryUpdate');
Route::get('hurricanesmenu/menu-categorytrash/{id}', 'MenuController@categoryTrash');

Route::get('hurricanesmenu/menu-ingredients', 'MenuController@ingredients')->name('menu.ingredients');
Route::post('hurricanesmenu/menu-ingredientscreate', 'MenuController@ingredientsCreate')->name('menu.ingredientCreate');
Route::post('hurricanesmenu/menu-ingredientsupdate', 'MenuController@ingredientsUpdate')->name('menu.ingredientUpdate');
Route::get('hurricanesmenu/menu-ingredientsbind/{id}', 'MenuController@ingredientsBind');

Route::get('hurricanesmenu/menu-menus', 'MenuController@menus')->name('menu.menus');
Route::post('hurricanesmenu/menu-menuscreate', 'MenuController@menusCreate')->name('menu.menuCreate');
Route::get('hurricanesmenu/menu-menusbind/{id}', 'MenuController@menusBind');
Route::post('hurricanesmenu/menu-menusupdate', 'MenuController@menuUpdate')->name('menu.menuUpdate');
Route::get('hurricanesmenu/menu-menus/show/{id}', 'MenuController@menusShow')->name('menu.menusShow');
Route::get('hurricanesmenu/menu-menus/recipe-create/{id}', 'MenuController@recipeCreate')->name('menu.recipeCreate');
Route::post('hurricanesmenu/menu-menus/recipe-create', 'MenuController@recipeStore')->name('menu.recipeStore');
Route::post('hurricanesmenu/menu-menus/recipe-add', 'MenuController@recipeAdd')->name('menu.recipeAdd');
Route::get('hurricanesmenu/menu-menus/recipe-edit/{id}', 'MenuController@recipeEdit')->name('menu.recipeEdit');
Route::get('hurricanesmenu/menu-recipebind/{id}', 'MenuController@recipeBind')->name('menu.recipeBind');
Route::post('hurricanesmenu/menu-menus/recipe-change', 'MenuController@recipeChange')->name('menu.recipeChange');
Route::get('hurricanesmenu/menu-menus/recipe-delete/{id}', 'MenuController@recipeDelete')->name('menu.recipeDelete');
Route::post('hurricanesmenu/menu-menuimage/', 'MenuController@menuImage')->name('menu.menuImage');


// Authentication //
Route::post('hurricanesmenu/login', 'Auth\AuthController@postLogin')->name('login');
Route::get('hurricanesmenu/logout', 'Auth\AuthController@getLogout')->name('logout');
// Route::auth();
