<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('role', 'Role');
Route::model('department', 'Department');
Route::model('marital', 'Marital');
Route::model('position', 'Position');
Route::model('periode', 'Periode');
Route::model('option', 'Option');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('department', '[0-9]+');
Route::pattern('marital', '[0-9]+');
Route::pattern('position', '[0-9]+');
Route::pattern('periode', '[0-9]+');
Route::pattern('option', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('before' => 'auth'), function()
{

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');
		
		# Department Management
    Route::get('departments/{department}/edit', 'AdminDepartmentsController@getEdit');
    Route::post('departments/{department}/edit', 'AdminDepartmentsController@postEdit');
    Route::get('departments/{department}/delete', 'AdminDepartmentsController@getDelete');
    Route::post('departments/{department}/delete', 'AdminDepartmentsController@postDelete');
    Route::controller('departments', 'AdminDepartmentsController');
		
		# Marital Management
    Route::get('maritals/{marital}/edit', 'AdminMaritalsController@getEdit');
    Route::post('maritals/{marital}/edit', 'AdminMaritalsController@postEdit');
    Route::get('maritals/{marital}/delete', 'AdminMaritalsController@getDelete');
    Route::post('maritals/{marital}/delete', 'AdminMaritalsController@postDelete');
    Route::controller('maritals', 'AdminMaritalsController');
		
		# Position Management
    Route::get('positions/{position}/edit', 'AdminPositionsController@getEdit');
    Route::post('positions/{position}/edit', 'AdminPositionsController@postEdit');
    Route::get('positions/{position}/delete', 'AdminPositionsController@getDelete');
    Route::post('positions/{position}/delete', 'AdminPositionsController@postDelete');
    Route::controller('positions', 'AdminPositionsController');
		
		# Periode Management
    Route::get('periodes/{periode}/edit', 'AdminPeriodesController@getEdit');
    Route::post('periodes/{periode}/edit', 'AdminPeriodesController@postEdit');
    Route::get('periodes/{periode}/delete', 'AdminPeriodesController@getDelete');
    Route::post('periodes/{periode}/delete', 'AdminPeriodesController@postDelete');
    Route::controller('periodes', 'AdminPeriodesController');
		
		# Setting Management
		Route::post('settings/save', 'AdminOptionController@postSave');
    Route::controller('settings', 'AdminOptionController');
		
    # Admin Dashboard
		Route::controller('dashboard', 'AdminDashboardController');
});

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');

Route::get('/', array('before' => 'detectLang','uses' => 'UserController@getLogin'));

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');