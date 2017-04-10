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
   // Auth::loginUsingId(2);
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

/*
 * Gruplama yöntemiyle arama alanındaki adminden sonra gelen bütün sayfaların yönlendirmesini burada yapıyoruz.
 * prefix arama alanındaki admin yazısını belirtiyoruz.
 * middleware 'de admin kontrolü için yarattığımız kontrolü belirtiyoruz
 * 'middleware'=>'admin' tanımladığımız middleware kontrolünü Kernel.php ' tanımladığımız adı 'admin'.
 *
 * Başka bir kısıtlama getirilceğinde örneğin
 * Route::group(['prefix'=>'admin','middleware'=>['moderator','admin']],function (){
 * şeklinde dünzenlebilir.
 */
Route::group(['prefix'=>'admin','middleware'=>'admin'],function (){
    /*
     * Adminden sonraki ilk yönlecek sayfayı direk / olarak belirtiyoruz.
     */
    Route::get('/', 'AdminController@get_admin');
    Route::get('/dashboard', 'AdminController@get_admin');
    Route::get('/haber-ekle',array('as'=>'haber-ekle','uses'=>'AdminController@get_haberEkle'));
    Route::post('/haber-ekle',array('as'=>'haber-ekle','uses'=>'AdminController@post_haberEkle'));
});

