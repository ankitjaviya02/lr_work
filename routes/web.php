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
    return view('welcome');
});

Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);

Route::any('demo1', ['as' => 'notfound', 'uses' => 'HomeController@demo1']);
Route::any('demo11', ['as' => 'notfound', 'uses' => 'HomeController@demo11']);



Route::group(['prefix' => 'admin'], function ()
{	
	$route_slug       = "admin_auth_";
	$route_controller = "Admin\AuthController@";

	Route::any('/product_info',['as'=>'product','uses'=>'Admin\InvoiceController@product_info']);

	Route::any('/product_delete',['as'=>'product','uses'=>'Admin\InvoiceController@product_delete']);

	Route::any('/product_save',['as'=>'product','uses'=>'Admin\InvoiceController@product_save']);
	Route::any('/settings',['as'=>'admin_auth_dashboard','uses'=>'Admin\DashboardController@settings']);
	Route::any('/setting_save',['as'=>'admin_auth_dashboard','uses'=>'Admin\DashboardController@setting_save']);

	Route::get('/',['as'=> $route_slug.'login',
						'uses'=> $route_controller.'login']);

	Route::get('/',['as'=> $route_slug.'login',
						'uses'=> $route_controller.'login']);

	Route::get('login',['as'=> $route_slug.'login',
							'uses'=> $route_controller.'login']);

	Route::get('create_admin',['as'=> $route_slug.'create_admin',
		'uses'=> $route_controller.'create_admin']);


	Route::post('process_login',['as'=> $route_slug.'process_login',
									 'uses'=> $route_controller.'process_login']);

	Route::any('/dashboard/{id?}',['as'=>'admin_auth_dashboard','uses'=>'Admin\DashboardController@index']);

	
	Route::any('forget_password',['as'=> $route_slug.'forgot_password',
											  'uses'=> $route_controller.'forget_password']);

	Route::any('change_password',['as'=> $route_slug.'change_password',
											  'uses'=> $route_controller.'change_password']);

	Route::any('update_password',['as'=> $route_slug.'update_password',
											  'uses'=> $route_controller.'update_password']);
	
	Route::post('process_forgot_password',['as'=> $route_slug.'forgot_password',
											  'uses'=> $route_controller.'process_forgot_password']);

	Route::get('profile',['as'=> $route_slug.'profile',
									 'uses'=> $route_controller.'profile']);

    Route::get('edit_profile',['as'=> $route_slug.'edit_profile',
									 'uses'=> $route_controller.'edit_profile']);

    Route::any('update_profile',['as'=> $route_slug.'update_profile',
									 'uses'=> $route_controller.'update_profile']);

	Route::get('/logout',['as'=> $route_slug.'logout','uses'=> $route_controller.'logout']);

	/* solution */
	Route::group(array('prefix'=>'solution'), function () 
	{
			$route_slug       = "solution";
			$route_controller = "Admin\SolutionController@";

		Route::get('/',['as' => $route_slug.'manage',  'uses' => $route_controller.'index']);		
		Route::get('/create', ['as' => $route_slug.'create','uses' => $route_controller.'create']); 
		Route::post('/store',['as' => $route_slug.'store',  'uses' => $route_controller.'store']); 	
		Route::get('view/{id}',['as' => $route_slug.'view',  'uses' => $route_controller.'view']); 
		Route::get('delete/{id}',['as' => $route_slug.'delete','uses' => $route_controller.'destroy']);
		Route::get('edit/{id}',['as' => $route_slug.'edit','uses' => $route_controller.'edit']);
		Route::post('update',['as'=> $route_slug.'update','uses'=> $route_controller.'update']);
		Route::any('demo',['as'=> $route_slug.'demo','uses'=> $route_controller.'demo']);
	});

});