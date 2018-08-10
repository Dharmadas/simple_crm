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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/customers/create', 'CustomerController@create')->name('customers.create');

Route::get('/users', 'UserController@displayList')->name('users');
Route::get('/users/data', 'UserController@getBusinessUnits')->name('users.data');
Route::get('/users/create', 'UserController@showCreateForm')->name('users.show_create_form');
Route::post('/users/create', 'UserController@addData')->name('users.add_data');
Route::get('/users/{id}/update', 'UserController@showUpdateForm')->name('users.update')->where('id', '[0-9]+');
Route::post('/users/update', 'UserController@updateData')->name('users.update_data');
Route::get('/user/profile', 'UserController@showProfile')->name('user.profile');

Route::get('/roles', 'RoleController@displayList')->name('roles');
Route::get('/roles/data', 'RoleController@getRoles')->name('roles.data');
Route::get('/roles/create', 'RoleController@showCreateForm')->name('roles.show_create_form');
Route::post('/roles/create', 'RoleController@addData')->name('roles.add_data');
Route::get('/roles/{id}/update', 'RoleController@showUpdateForm')->name('roles.update')->where('id', '[0-9]+');
Route::post('/roles/update', 'RoleController@updateData')->name('roles.update_data');

Route::get('/permissions', 'PermissionController@displayList')->name('permissions');
Route::get('/permissions/data', 'PermissionController@getRoles')->name('permissions.data');
Route::get('/permissions/create', 'PermissionController@showCreateForm')->name('permissions.show_create_form');
Route::post('/permissions/create', 'PermissionController@addData')->name('permissions.add_data');

Route::get('/business_units', 'BusinessUnitController@displayList')->name('business_units');
Route::get('/business_units/data', 'BusinessUnitController@getBusinessUnits')->name('business_units.data');
Route::get('/business_units/create', 'BusinessUnitController@showCreateForm')->name('business_units.show_create_form');
Route::post('/business_units/create', 'BusinessUnitController@addData')->name('business_units.add_data');
Route::get('/business_units/{id}/update', 'BusinessUnitController@showUpdateForm')->name('business_units.update')->where('id', '[0-9]+');
Route::post('/business_units/update', 'BusinessUnitController@updateData')->name('business_units.update_data');

Route::get('/departments', 'DepartmentController@displayList')->name('departments');
Route::get('/departments/data', 'DepartmentController@getDepartments')->name('departments.data');
Route::get('/departments/create', 'DepartmentController@showCreateForm')->name('departments.show_create_form');
Route::post('/departments/create', 'DepartmentController@addData')->name('departments.add_data');
Route::get('/departments/{id}/update', 'DepartmentController@showUpdateForm')->name('departments.update')->where('id', '[0-9]+');
Route::post('/departments/update', 'DepartmentController@updateData')->name('departments.update_data');

Route::get('/campaigns', 'CampaignController@displayList')->name('campaigns');
Route::get('/campaigns/data', 'CampaignController@getCampaigns')->name('campaigns.data');
Route::get('/campaigns/create', 'CampaignController@showCreateForm')->name('campaigns.show_create_form');
Route::post('/campaigns/create', 'CampaignController@addData')->name('campaigns.add_data');
Route::get('/campaigns/{id}/update', 'CampaignController@showUpdateForm')->name('campaigns.update')->where('id', '[0-9]+');
Route::post('/campaigns/update', 'CampaignController@updateData')->name('campaigns.update_data');

Route::get('/dispositions', 'DispositionController@displayList')->name('dispositions');
Route::get('/dispositions/data', 'DispositionController@getDispositions')->name('dispositions.data');
Route::get('/dispositions/create', 'DispositionController@showCreateForm')->name('dispositions.show_create_form');
Route::post('/dispositions/create', 'DispositionController@addData')->name('dispositions.add_data');
Route::get('/dispositions/{id}/update', 'DispositionController@showUpdateForm')->name('dispositions.update')->where('id', '[0-9]+');
Route::post('/dispositions/update', 'DispositionController@updateData')->name('dispositions.update_data');

Route::get('/customers', 'CustomerController@displayList')->name('customers');
Route::get('/customers/data', 'CustomerController@getCustomers')->name('customers.data');
Route::get('/customers/create', 'CustomerController@showCreateForm')->name('customers.show_create_form');
Route::post('/customers/create', 'CustomerController@addData')->name('customers.add_data');
Route::get('/customers/{id}/update', 'CustomerController@showUpdateForm')->name('customers.update')->where('id', '[0-9]+');
Route::post('/customers/update', 'CustomerController@updateData')->name('customers.update_data');
Route::get('/customers/{id}/updates', 'CustomerController@displayUpdates')->where('id', '[0-9]+');
Route::post('/customers/add_update', 'CustomerController@addUpdate')->name('customers.add_update');
Route::post('/customers', 'CustomerController@search')->name('customers.search');