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


Route::group(['middleware'=>['auth']],function(){

Route::get('/', 'DrugstoreController@show')->name('my.drugstores');
//Route::get('/', 'DrugstoreController@showMsg')->name('show.msg');
Route::post('/', 'DrugstoreController@create')->name('create.drugstore');
Route::post('/delete/{id}', 'DrugstoreController@destroy')->name('destroy.drugstore');
Route::post('/drugstore/{id}', 'ContentController@create')->name('new.medicine');
//Route::post('/drugstore/add/{id}', 'ContentController@addMedicine')->name('add.med');
Route::resource('/content', 'ContentController');
Route::get('/showcontent/{id}', 'ContentController@showContent')->name('content.showcontent');
Route::post('/takemedicine/{id}', 'ContentController@takeMedicine')->name('content.takemedicine');
Route::get('/logs/{id}','LogController@index')->name('logs');
//Route::post('/raports','LogController@showReport')->name('show.logreport');
Route::get('/raports','LogController@showReport')->name('show.logreport');
Route::post('/adduser/{id}', 'DrugstoreController@addUser')->name('add.user');
Route::get('/group/{id}', 'DrugstoreController@users')->name('groups');
Route::post('/group/{drugstore_id}/delete/{user_id}', 'DrugstoreController@destroyuser')->name('destroy.user');
Route::post('/group-all/{drugstore_id}','DrugstoreController@destroyallusers')->name('destroy.usergroup');

Route::get('/ajaxSetReadNotification', 'NotificationController@ajaxSetReadNotification'); /* Lecture 50 */
Route::get('/ajaxGetNotShownNotifications', 'NotificationController@ajaxGetNotShownNotifications');
Route::get('/ajaxSetShownNotifications', 'NotificationController@ajaxSetShownNotifications');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



