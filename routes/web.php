<?php

Route::get('/logowanie', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/logowanie', 'Auth\LoginController@login');
Route::get('/wyloguj', 'Auth\LoginController@logout')->name('logout');

Route::get('/rejestracja', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/rejestracja', 'Auth\RegisterController@register');

Route::get('/','HomeController@index');
Route::name('home_path')->get('/','HomeController@index');

Route::group(['middleware' => ['auth']], function(){
	Route::group(['middleware' => ['is.admin']],function(){
		Route::get('/admin',function(){
			return view('admin');
		});	

		
		Route::resource('kategoria','CategoryController')->except(['show']);
		Route::resource('miasto','CityController')->except(['show']);
	});
	Route::group(['middleware' => ['is.editor']],function(){
		Route::resource('praca','JobController')->except(['index', 'show']);
		Route::resource('firma','CompanyController')->except(['index', 'show']);
	});

	Route::name('accept_worker')->get('/konto/{id_w}/{id_c}/accept','AccountController@accept_worker');
	Route::name('reject_worker')->get('/konto/{id_w}/{id_c}/reject','AccountController@reject_worker');
	Route::name('apply_worker')->get('/konto/{id_w}/{id_c}/apply','AccountController@apply_worker');
});


Route::resource('praca','JobController')->only(['index', 'show']);
Route::name('save_job_path')->get('/praca/{id}/save', 'JobController@save_job');
Route::name('unsave_job_path')->get('/praca/{id}/unsave', 'JobController@unsave_job');

Route::resource('firma','CompanyController')->only(['index','show']);

Route::resource('kategoria','CategoryController')->only(['show']);

Route::resource('miasto','CityController')->only(['show']);

Route::name('search_path')->post('/szukaj','SearchController@index');

Route::name('account_path')->get('/konto','AccountController@show');