<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TelephonesController;
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


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/', [MainController::class, 'Index'])->name('home.index');
Route::get('/show/{id}',[MainController::class, 'show'])->name('main.show');
//Route::get('/employee',[MainController::class,'index']);
Route::post('/employee/search',[MainController::class,'showEmployee'])->name('employee.search');

Route::get('/admin', [AdminController::class, 'Index'])->name('admin-index')->middleware('auth');;
Route::get('/admin/show/{id}',[AdminController::class, 'show'])->name('admin-show');
Route::get('/admin/positions/',[AdminController::class, 'AllPositions'])->name('admin-positions');
//Route::get('/admin/static/',[AdminController::class, 'StaticTel'])->name('tel.static');
//Route::get('/admin/mobile/',[AdminController::class, 'MobileTel'])->name('tel.mobile');

Route::post('/admin/positions-update/{id}/', [AdminController::class, 'update'])->name('positions.update');
Route::post('/admin/positions-add/', [AdminController::class, 'updateAllRecords'])->name('positions.add');
Route::post('/admin/create/{id}/', [AdminController::class, 'addPositions'])->name('add-positions');
Route::delete('/admin/destroy/{id}/', [AdminController::class, 'destroyRecord'])->name('record.destroy');
//Route::post('/admin/edit/{id}/', [AdminController::class, 'edit'])->name('positions.edit');
Route::post('/admin/change-positions/{id}/', [AdminController::class, 'changePositions'])->name('positions.change');
Route::post('/admin/change-abonents/', [AdminController::class, 'changeAbonents'])->name('abonents.change');
Route::post('/admin/change-confirm/{var}/{id}/{$check}/', [AdminController::class, 'isConfirmed'])->name('confirm.change');

Route::post('/admin/create-pos-confirm/{id}/', [AdminController::class, 'ConfirmAll'])->name('create-positions.confirm');

Route::post('/admin/get/Answer/', [AdminController::class, 'GetAnswer'])->name('get-answer');
Route::post('/get/static/tel-answer/', [AdminController::class, 'CheckStatic'])->name('static-answer');




Route::post('/admin/confirm-abonents/{ids}/{dep_id}/', [AdminController::class, 'AbonentConfirm'])->name('abonents.confirm');
Route::post('/admin/change-mobile/{id}/', [AdminController::class, 'changeMobile'])->name('mobile.change');
Route::post('/admin/change-static/{id}/', [AdminController::class, 'changeStatic'])->name('static.change');
Route::post('/admin/add-static/{id}/', [AdminController::class, 'AddStaticTel'])->name('static.add');
//Route::post('/admin/dw/{id}/', [AdminController::class, 'changeAbonents'])->name('abonents.change');



Route::get('/static-tel/show/', [TelephonesController::class, 'StaticTel'])->name('static-phone');
Route::get('/inactive/departments/', [DepartmentsController::class, 'inActive'])->name('inActive');
Route::get('/mobile-tel/show/', [TelephonesController::class, 'MobileTel'])->name('mobile-phone');
Route::post('/admin/static-tel-add/', [TelephonesController::class, 'AddStaticTel'])->name('static-tel.add');
Route::post('/admin/mobile-tel-add/', [TelephonesController::class, 'AddMobileTel'])->name('mobile-tel.add');
Route::post('/mobile-tel/{id}/', [TelephonesController::class, 'EditMobileTel'])->name('mobile-tel.edit');
Route::post('/static-tel/{id}/', [TelephonesController::class, 'EditStaticTel'])->name('static-tel.edit');
Route::post('/admin/static-tel/destroy/{id}', [TelephonesController::class, 'DestroyStaticTel'])->name('staticTel.destroy');
Route::post('/admin/mobile-tel/destroy/{id}', [TelephonesController::class, 'DestroyMobileTel'])->name('mobileTel.destroy');



Route::resource('abonent', 'App\Http\Controllers\AbonentsController'); // Laravel 8
Route::resource('admin', 'App\Http\Controllers\AdminController');
Route::resource('position', 'App\Http\Controllers\PositionsController');
Route::resource('departments', 'App\Http\Controllers\DepartmentsController');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
