<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\configuration\SiegesController;
use App\Http\Controllers\configuration\StructuresController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\FormationController;

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
	return view('home');
})->name('home')->middleware(['auth']);

$controller_path = 'App\Http\Controllers';


Route::controller(UserController::class)->middleware('auth')->name('users.')->group(function () {
	Route::get('/users', 'index')->name('index');
	Route::post('/users', 'store')->name('store');
	Route::get('/users/create', 'create')->name('create');
	Route::get('/users/{user}/edit', 'edit')->name('edit');
	Route::put('/users/{user}/update', 'update')->name('update');
	Route::delete('/users/{user}/delete', 'delete')->name('delete');
});

Route::group(['middleware' => ['auth']], function() {

Route::get('auto-complete-search', [StructuresController::class, 'autocompletesearch'])->name('autocompletesearch');
Route::resource('configurations/structures',StructuresController::class);
Route::resource('configurations/sieges',SiegesController::class);
Route::resource('configurations/affectations',AffectationController::class);
Route::resource('configurations/formations',FormationController::class);


Route::resource('admins/roles', RolesController::class);
Route::resource('admins/permissions', PermissionsController::class);


});


// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');


require 'auth.php';
