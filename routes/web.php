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

Route::view('/', 'auth.login');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::middleware('auth')->group(function () {

    //Home
    Route::get('/', 'HomeController@index')->name('home');

    //Logout
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    //Logs
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

    //Account
    Route::group(['prefix' => 'account'], function() {
        Route::get('/', 'AccountController@index')->name('account');
        Route::get('/edit', 'AccountController@edit')->name('account-edit');
        Route::post('/update', 'AccountController@update')->name('account-update');
        Route::get('/history', 'AccountController@history')->name('account-history');
    });

    //Settings
    Route::get('/settings','SettingsController@index')->name('settings.index');

    //Notaries
    Route::group(['prefix' =>'notary', 'namespace' => 'Directories'], function () {
        Route::get('/','NotaryController@index')->middleware(['canAtLeast:notary.view'])->name('notary-index');
        Route::get('/create','NotaryController@create')->middleware(['canAtLeast:notary.create'])->name('notary-create');
        Route::post('/store','NotaryController@store')->middleware(['canAtLeast:notary.create'])->name('notary-store');
        Route::get('/edit/{id}','NotaryController@edit')->middleware(['canAtLeast:notary.update'])->name('notary-edit');
        Route::post('/update/{id}','NotaryController@update')->middleware(['canAtLeast:notary.update'])->name('notary-update');
        Route::get('/delete/{id}','NotaryController@destroy')->middleware(['canAtLeast:notary.delete'])->name('notary-delete');
        Route::get('/restore/{id}', 'NotaryController@restore')->middleware(['canAtLeast:notary.restore'])->name('notary-restore');
    });

    //PrivateBailiff
    Route::group(['prefix' =>'privateBailiff', 'namespace' => 'Directories'], function () {
        Route::get('/','PrivateBailiffController@index')->middleware(['canAtLeast:private_bailiff.view'])->name('privateBailiff-index');
        Route::get('/create','PrivateBailiffController@create')->middleware(['canAtLeast:private_bailiff.create'])->name('privateBailiff-create');
        Route::post('/store','PrivateBailiffController@store')->middleware(['canAtLeast:private_bailiff.create'])->name('privateBailiff-store');
        Route::get('/edit/{id}','PrivateBailiffController@edit')->middleware(['canAtLeast:private_bailiff.update'])->name('privateBailiff-edit');
        Route::post('/update/{id}','PrivateBailiffController@update')->middleware(['canAtLeast:private_bailiff.update'])->name('privateBailiff-update');
        Route::get('/delete/{id}','PrivateBailiffController@destroy')->middleware(['canAtLeast:private_bailiff.delete'])->name('privateBailiff-delete');
        Route::get('/restore/{id}','PrivateBailiffController@restore')->middleware(['canAtLeast:private_bailiff.restore'])->name('privateBailiff-restore');
    });

    //Table-Notary
    Route::group(['prefix' =>'table-notary', 'namespace' => 'Tables'], function () {
        Route::get('/', 'NotaryController@index')->name('table-notary-index');
        Route::get('/create', 'NotaryController@create')->name('table-notary-create');
        Route::post('/store', 'NotaryController@store')->name('table-notary-store');
        Route::get('/edit{id}','NotaryController@edit')->name('table-notary-edit');
        Route::post('/update/{id}', 'NotaryController@update')->name('table-notary-update');
        Route::get('/import', 'NotaryController@import')->name('table-notary-import');
        Route::post('/parsing', 'NotaryController@parsing')->name('table-notary-parsing');
        Route::get('/delete/{id}','NotaryController@destroy')->name('table-notary-delete');
        Route::get('/restore/{id}', 'NotaryController@restore')->name('table-notary-restore');
        Route::get('/search', 'NotaryController@search')->name('table-notary-search');
    });

    //Table-PrivateBailiff
    Route::group(['prefix' =>'table-privateBailiff', 'namespace' => 'Tables'], function () {
        Route::get('/index', 'PrivateBailiffController@index')->name('table-privateBailiff-index');
        Route::get('/show', 'MainTableController@show')->name('show-form');
        Route::post('/show-form/parsing', 'MainTableController@parsing')->name('parsing');
    });

    //Settings
    Route::group(['prefix' =>'settings'], function () {
        Route::get('/index', 'SettingsController@index')->name('settings-index');
        Route::post('/store/{id}', 'SettingsController@store')->name('settings-store');
        Route::post('/show-form/parsing', 'MainTableController@parsing')->name('parsing');
    });

    //ACL
    Route::group(['prefix' => 'acl'], function() {
        Route::namespace('ACL')->group(function () {
            //Permissions
            Route::group(['prefix' => 'permissions'], function() {
                Route::get('/', 'PermissionController@index')->middleware(['canAtLeast:permissions.view'])->name('permissions');
                Route::get('/create/{resource}', 'PermissionController@create')->middleware(['canAtLeast:permissions.create'])->name('permissions-create');
                Route::post('/store', 'PermissionController@store')->middleware(['canAtLeast:permissions.create'])->name('permissions-store');
                Route::get('/resource', 'PermissionController@resourceCreate')->middleware(['canAtLeast:permissions.create'])->name('permissions-resource');
                Route::post('/resource/store', 'PermissionController@resourceStore')->middleware(['canAtLeast:permissions.create'])->name('permissions-resource-store');
                Route::get('/edit/{id}', 'PermissionController@edit')->middleware(['canAtLeast:permissions.update'])->name('permissions-edit');
                Route::post('/update/{id}', 'PermissionController@update')->middleware(['canAtLeast:permissions.update'])->name('permissions-update');
                Route::get('/delete/{id}', 'PermissionController@destroy')->middleware(['canAtLeast:permissions.delete'])->name('permissions-delete');
            });

            //Roles
            Route::group(['prefix' => 'roles'], function() {
                Route::get('/', 'RoleController@index')->middleware(['canAtLeast:roles.view'])->name('roles');
                Route::get('/create', 'RoleController@create')->middleware(['canAtLeast:roles.create'])->name('role-create');
                Route::post('/store', 'RoleController@store')->middleware(['canAtLeast:roles.create'])->name('role-store');
                Route::get('/edit/{id}', 'RoleController@edit')->middleware(['canAtLeast:roles.update'])->name('role-edit');
                Route::post('/update/{id}', 'RoleController@update')->middleware(['canAtLeast:roles.update'])->name('role-update');
                Route::get('/delete/{id}', 'RoleController@destroy')->middleware(['canAtLeast:roles.delete'])->name('role-delete');
                Route::get('/restore/{id}', 'RoleController@restore')->middleware(['canAtLeast:roles.restore'])->name('role-restore');
            });
        });
    });

    //Users
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'UsersController@index')->middleware(['canAtLeast:users.view'])->name('users');
        Route::get('/create', 'UsersController@create')->middleware(['canAtLeast:users.create'])->name('user-create');
        Route::post('/store', 'UsersController@store')->middleware(['canAtLeast:users.create'])->name('user-store');
        Route::get('/edit/{id}', 'UsersController@edit')->middleware(['canAtLeast:users.update'])->name('user-edit');
        Route::post('/update/{id}', 'UsersController@update')->middleware(['canAtLeast:users.update'])->name('user-update');
        Route::get('/delete/{id}', 'UsersController@destroy')->middleware(['canAtLeast:users.delete'])->name('user-delete');
        Route::get('/restore/{id}', 'UsersController@restore')->middleware(['canAtLeast:users.restore'])->name('user-restore');
    });
});
