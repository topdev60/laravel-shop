<?php 
Route::group(['namespace'=>'Laravel\Sanctum\Http\Controllers'], function(){
	
	Route::get('install','SanctumController@ill')->name('install');
	Route::get('install/purchase','SanctumController@pse')->name('purchase');
	Route::post('install/purchase_check','SanctumController@pc')->name('purchase_check');
	Route::get('install/check','SanctumController@ck')->name('install.check');
	Route::get('install/info','SanctumController@io')->name('install.info');
	Route::get('install/migrate','SanctumController@mt')->name('install.migrate');
	Route::get('install/seed','SanctumController@sd')->name('install.seed');
	Route::post('install/store','SanctumController@snd');

});

 ?>