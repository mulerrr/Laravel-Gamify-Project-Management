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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//->middleware('auth');

Route::middleware(['auth'])->group(function(){

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/homeProgrammer', 'ProgrammerController@index')->name('homeProgrammer');
	Route::get('/home-client', 'ClientController@index')->name('homeClient');

	Route::resource('companies', 'CompaniesController');

	Route::get('projects/create/{company_id?}', 'ProjectsController@create');
	Route::post('projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
	Route::resource('projects', 'ProjectsController');

	Route::get('export', 'TasksController@taskExport')->name('task.export');
	Route::post('import', 'TasksController@taskImport')->name('task.import');

	Route::resource('roles', 'RolesController');
	Route::resource('tasks', 'TasksController');

	Route::resource('users', 'UsersController');
	Route::get('users/changeRoleEdit/{id}', 'UsersController@changeRoleEdit');
	Route::get('/performance-detail/{user_id}', 'UsersController@performanceDetail')->name('performanceDetail');
	Route::post('users/changeAvatar', 'UsersController@changeAvatar')->name('users.changeAvatar');
	Route::post('users/userUpdate', 'UsersController@userUpdate')->name('users.userUpdate');
	Route::post('users/userInactive', 'UsersController@userInactive')->name('users.userInactive');

	Route::resource('presences', 'PresencesController');
	Route::resource('surveys', 'SurveysController');
	Route::resource('reviews', 'ReviewsController');

	Route::resource('comments', 'CommentsController');

	Route::get('/markAsRead', function(){
		auth()->user()->unreadNotifications->markAsRead();
	});

});