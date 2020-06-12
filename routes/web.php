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

Route::get('/', 'BaseController@index')->name('base');

Route::get('/user', 'UserPanelController@index')->name('user.dashboard')->middleware('auth','verified');
Route::get('/user/profile', 'UserPanelController@profile')->name('user.profile')->middleware('auth', 'verified');
Route::get('/user/orders', 'UserPanelController@orders')->name('user.orders')->middleware('auth', 'verified');
// Route::get('/user/notifications', 'UserPanelController@notifications')->name('user.notifications')->middleware('auth', 'verified');

Route::post('/user/photo', 'UserController@add_photo')->name('user.add_photo')->middleware('auth', 'verified');
Route::post('/user/update/{id?}', 'UserController@update')->name('user.update')->middleware('auth', 'verified');
Route::post('/user/change-password', 'UserController@change_password')->name('user.change_password')->middleware('auth', 'verified');
Route::get('/user/destroy/{id}', 'UserController@destroy')->name('user.destroy')->middleware('admin');
Route::get('/user/restore/{id}', 'UserController@restore')->name('user.restore')->middleware('admin');
Route::get('/user/verify-now/{id}', 'UserController@verify_now')->name('user.verify_now')->middleware('admin');
Route::get('/user/resend-verify-email/{id}', 'UserController@resend_verify_email')->name('user.resend_verify_email')->middleware('admin');
Route::post('/user/create', 'UserController@create')->name('user.create')->middleware('admin');

Route::get('/admin', 'AdminController@index')->name('admin.dashboard')->middleware('auth', 'admin');
Route::get('/admin/users/{type?}', 'AdminController@users')->name('admin.users')->middleware('auth', 'admin');
Route::get('/admin/profile', 'AdminController@profile')->name('admin.profile')->middleware('auth', 'admin');
Route::get('/admin/orders/{type?}', 'AdminController@orders')->name('admin.orders')->middleware('auth', 'admin');
// Route::get('/admin/notifications', 'AdminController@notifications')->name('admin.notifications')->middleware('auth', 'admin');
Route::get('/admin/settings', 'AdminController@settings')->name('admin.settings')->middleware('auth', 'admin');
Route::get('/admin/edit-user/{user}', 'AdminController@edit_user')->name('admin.edit_user')->middleware('auth', 'admin');
Route::get('/admin/add-user', 'AdminController@add_user')->name('admin.add_user')->middleware('auth', 'admin');
Route::get('/admin/subscribers/{type?}', 'AdminController@subscribers')->name('admin.subscribers')->middleware('auth', 'admin');
Route::get('/admin/services/{type?}', 'AdminController@services')->name('admin.services')->middleware('auth', 'admin');
Route::get('/admin/sub-services/{type?}', 'AdminController@sub_services')->name('admin.sub_services')->middleware('auth', 'admin');
Route::get('/admin/add-sub-service', 'AdminController@add_sub_service')->name('admin.add_sub_service')->middleware('auth', 'admin');
Route::get('/admin/edit-sub-service/{service}', 'AdminController@edit_sub_service')->name('admin.edit_sub_service')->middleware('auth', 'admin');
Route::get('/admin/add-service', 'AdminController@add_service')->name('admin.add_service')->middleware('auth', 'admin');
Route::get('/admin/edit-service/{service}', 'AdminController@edit_service')->name('admin.edit_service')->middleware('auth', 'admin');
Route::get('/admin/products/{type?}', 'AdminController@products')->name('admin.products')->middleware('auth', 'admin');
Route::get('/admin/add-product', 'AdminController@add_product')->name('admin.add_product')->middleware('auth', 'admin');
Route::get('/admin/edit-product/{product}', 'AdminController@edit_product')->name('admin.edit_product')->middleware('auth', 'admin');

Route::post('/order', 'OrderController@store')->name('order.product')->middleware('auth');
Route::get('/order/destroy/{order}', 'OrderController@destroy')->name('order.destroy')->middleware('auth');
Route::get('/order/restore/{order}', 'OrderController@restore')->name('order.restore')->middleware('admin');
Route::get('/order/confirm/{order}', 'OrderController@confirm')->name('order.confirm')->middleware('admin');
Route::get('/order/verify-payment/{ref}/{id}/{cost}', 'OrderController@verify_payment')->name('order.verify_payment')->middleware('auth');

Route::post('/subscriber', 'SubscriberController@store')->name('subscriber.store');
Route::get('/subscriber/restore/{subscriber}', 'SubscriberController@restore')->name('susbcriber.restore')->middleware('admin');
Route::get('/subscriber/delete/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy')->middleware('admin');

Route::post('/service', 'ServiceController@store')->name('service.store');
Route::post('/service/update/{service}', 'ServiceController@update')->name('service.update');
Route::get('/service/restore/{service}', 'ServiceController@restore')->name('service.restore')->middleware('admin');
Route::get('/service/destroy/{service}', 'ServiceController@destroy')->name('service.destroy')->middleware('admin');

Route::post('/menu', 'MenuController@store')->name('menu.store');
Route::post('/menu/update/{menu}', 'MenuController@update')->name('menu.update');
Route::get('/menu/restore/{menu}', 'MenuController@restore')->name('menu.restore')->middleware('admin');
Route::get('/menu/destroy/{menu}', 'MenuController@destroy')->name('menu.destroy')->middleware('admin');

Route::post('/product', 'ProductController@store')->name('product.store');
Route::post('/product/update/{product}', 'ProductController@update')->name('product.update');
Route::get('/product/restore/{product}', 'ProductController@restore')->name('product.restore')->middleware('admin');
Route::get('/product/destroy/{product}', 'ProductController@destroy')->name('product.destroy')->middleware('admin');

Auth::routes(['verify' => true]);

Route::get('/{main}/{sub}', 'BaseController@service');


Route::get('/home', 'HomeController@index')->name('home');
