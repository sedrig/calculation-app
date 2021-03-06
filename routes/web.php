<?php

use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/',function (){
    return view('general');
})->name('general');
Route::get('/general', [MainController::class, 'index'])->name('home');



Route::post('/update', [UserController::class, 'update_login'])->name('update_login');
Route::get('/update_service', [AdminController::class, 'update'])->name('edit_service')->middleware('id_admin');
Route::get('/admin/adminpanel', [MainController::class, 'adminpanel'])->name('admin')->middleware('id_admin');
Route::get('/user/profile', [MainController::class, 'user'])->name('profile')->middleware('isLogged');
Route::get('/user/logout', [MainController::class, 'logout'])->name('logout');
Route::get('/login', [MainController::class, 'login'])->name('login')->middleware('AlreadyLoggedIn');
Route::get('/register', [MainController::class, 'register'])->name('register')->middleware('AlreadyLoggedIn');
Route::post('/create', [MainController::class, 'create'])->name('create_user');
Route::post('/check', [MainController::class, 'check'])->name('check');
Route::post('/save', [MainController::class, 'save_home'])->name('save_home');
Route::post('/see/{index?}', [MainController::class, 'see_home'])->name('see_home');

Route::get('/service/delete/{id?}', [AdminController::class, 'service_destroy'])->name('service_destroy')->middleware('id_admin');
Route::get('/type/delete/{id?}', [AdminController::class, 'type_destroy'])->name('type_destroy')->middleware('id_admin');
Route::get('/family/delete/{id?}', [AdminController::class, 'family_destroy'])->name('family_destroy')->middleware('id_admin');

Route::resource('family', FamilyController::class);
Route::resource('type', TypeController::class);
Route::resource('service', ServiceController::class);

Route::get('/user/profile/settings', [UserController::class, 'settings'])->name('settings')->middleware('isLogged');

Route::get('/user/profile/{id?}', [UserController::class, 'delete_calc'])->name('delete_calc')->middleware('isLogged');
Route::get('/{id?}', [MainController::class, 'index_show'])->name('home_show')->middleware('isLogged');
Route::get('/{id?}/{col?}', [MainController::class, 'index_show'])->name('home_return')->middleware('isLogged');
