<?php

Route::get('/logowanie', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/logowanie', 'Auth\LoginController@login');
Route::get('/wyloguj', 'Auth\LoginController@logout')->name('logout');

Route::get('/rejestracja', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/rejestracja', 'Auth\RegisterController@register');

Route::group(['middleware' => ['auth']], function(){
	Route::group(['middleware' => ['is.admin']],function(){
		Route::get('/admin',function(){
			return view('admin');
		});	

		Route::resource('firma','CompanyController')->except(['index', 'show']);
		Route::resource('kategoria','CategoryController')->except(['index','show']);
		Route::resource('miasto','CityController')->except(['index','show']);
	});
	Route::group(['middleware' => ['is.editor']],function(){
		Route::resource('praca','JobController')->except(['index', 'show']);
	});
});

Route::name('home_path')->get('/','HomeController@index');

Route::resource('praca','JobController')->only(['index', 'show']);
Route::name('save_job_path')->get('/praca/{id}/save', 'JobController@save_job');
Route::name('unsave_job_path')->get('/praca/{id}/unsave', 'JobController@unsave_job');

Route::resource('firma','CompanyController')->only(['index','show']);

Route::resource('kategoria','CategoryController')->only(['index','show']);

Route::resource('miasto','CityController')->only(['index','show']);

Route::name('search_path')->post('/szukaj','SearchController@index');

Route::name('account_path')->get('/konto','AccountController@show');