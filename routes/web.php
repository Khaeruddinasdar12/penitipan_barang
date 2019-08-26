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

Route::get('/home', 'HomeController@index')->name('dashboard1');
Route::get('/riwayat-penitipan', 'HomeController@histories')->name('histories');

Route::get('/penitipan', 'HomeController@items')->name('items');

// Route::get('/tombol',function(){
// 	return view('tombolapi');
// });

// Route::resource('api', 'ApiDataBarang');

Route::get('/tablebarang', 'HomeController@table_barang')->name('tablebarang');
Route::get('/tablehistories', 'HomeController@tablehistories')->name('tablehistories');

Route::get('user', 'User@index')->name('user.index');
Route::get('/tableuser', 'User@tableuser')->name('tableuser');

Route::group(['middleware' => 'App\Http\Middleware\KelolaPenitipan'], function() {
	Route::post('/items', 'HomeController@add_items');
	Route::get('/items/{id}/edit', 'HomeController@show_edit_items');
	Route::put('/items/{id}', 'HomeController@edit_items');
	Route::put('/items-back/{id}', 'HomeController@items_back');
	Route::delete('/items/{id}', 'HomeController@delete_items');
});


Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function() {
	Route::delete('/riwayat/{id}', 'HomeController@delete_riwayat');
	Route::post('user', 'User@store')->name('user.store');
	Route::get('user/{id}/edit', 'User@edit');
	Route::delete('user/{id}', 'User@destroy');
	// Route::delete('pernahpinjam/{id}', 'Transaksi@hapuspernahpinjam');
	Route::put('user/{id}', 'User@update');
});
