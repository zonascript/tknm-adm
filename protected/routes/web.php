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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register',function(){
    return view('404');
});
Route::post('/changepassword', 'AdminController@changePwd');

Route::get('/listMembers', 'UserController@listMembers');

Route::get('/agreement', 'SettingController@agreement');
Route::post('/agreement', 'SettingController@agreementProcess');

Route::get('/listwalleteth', 'SettingController@listWalletEth');
Route::get('/deletewalleteth/{id}','SettingController@deleteWalletEth');
Route::post('/addwalleteth','SettingController@addWalletEth');
Route::post('/editwalleteth','SettingController@editWalletEth');

Route::get('/configico', 'SettingController@listConfigIco');
Route::post('/editconfigico','SettingController@editConfigIco');

Route::get('/listadmin', 'AdminController@listAdmin');
Route::get('/deleteadmin/{id}','AdminController@deleteAdmin');
Route::post('/addadmin','AdminController@addAdmin');
Route::post('/editadmin','AdminController@editAdmin');

Route::get('/listrole', 'AdminController@listRole');
Route::get('/deleterole/{id}','AdminController@deleteRole');
Route::post('/addrole','AdminController@addRole');
Route::post('/editrole','AdminController@editRole');

Route::get('/permission/{role?}', 'AdminController@listPermission');
Route::get('/deletepermission/{role_id}/{menu_id}', 'AdminController@deletePermission');
Route::get('/grantpermission/{role_id}/{menu_id}', 'AdminController@grantPermission');

Route::get('/listbuyereth', 'UserController@listBuyerEth');
Route::get('/listbuyerbtc', 'UserController@listBuyerBtc');

//ajax
Route::get('/getMemberCount', 'HomeController@getMemberCount');