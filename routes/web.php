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

Route::get('/user_admin', function(){
    \Illuminate\Support\Facades\Auth::loginUsingId(1);
});
Route::get('/user', function(){
    \Illuminate\Support\Facades\Auth::loginUsingId(2);
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return redirect()->route('admin.home');
});

Route::group(['prefix'=>'public'], function(){
    Route::get('show/{id}','PontoTuristicoController@showPontoTur')->name('show');
    Route::get('xml_cultura','PontoTuristicoController@xml_cultura')->name('xml_cultura');
    Route::get('xml_musica','PontoTuristicoController@xml_musica')->name('xml_musica');
    Route::get('mobile/{chavedeacesso}/{idcliente}/{idponto}','PontoTuristicoController@mobile')->name('mobille');
});

Route::group([
    'prefix' => 'admin',
    'as'=>'admin.'
],  function(){

    Auth::routes();
    Route::group(['middleware' => 'can:access-admin'], function(){
        Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['prefix'=>'home/user', 'as'=>'user.'], function(){
            Route::get('index', 'UserController@index')->name('index');
            Route::get('create', 'UserController@create')->name('create');
            Route::post('store', 'UserController@store')->name('store');
            Route::get('edit/{id}', 'UserController@edit')->name('edit');
            Route::post('update/{id}', 'UserController@update')->name('update');
            Route::get('destroy/{id}', 'UserController@destroy')->name('destroy');

            //Rotas para exibir os dados coletados
            Route::get('map1', 'UserController@map1')->name('map1');
        });

        Route::group(['prefix'=>'ponto-turistico', 'as'=>'ponto-turistico.'], function(){
            Route::get('index', 'PontoTuristicoController@index')->name('index');
            Route::get('show/{id}', 'PontoTuristicoController@show')->name('show');
            Route::get('gerarQr/{id}','PontoTuristicoController@gerarQrCode')->name('gerarQr');
            Route::get('create', 'PontoTuristicoController@create')->name('create');
            Route::post('store', 'PontoTuristicoController@store')->name('store');
            Route::get('edit/{id}', 'PontoTuristicoController@edit')->name('edit');
            Route::put('update/{id}', 'PontoTuristicoController@update')->name('update');
            Route::get('destroy/{id}', 'PontoTuristicoController@destroy')->name('destroy');
            ##############################################################################
            Route::get('gallery/{id}', 'PontoTuristicoController@createGallery')->name('create_gallery');
            Route::post('store_gallery', 'PontoTuristicoController@store_gallery')->name('store_gallery');

            Route::get('xml', 'PontoTuristicoController@gerarXml')->name('gerarXml');

        });
    });
});

