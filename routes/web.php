<?php

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

Route::get('/', function () {
	return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;

Route::get('/', [MainController::class, 'index'])->middleware('guest')->name('guest');

// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
// Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
// Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
// Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
// Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	Route::get("package/index", [PackageController::class, "index"])->name("packages.index");
	Route::get("package/create", [PackageController::class, "create"])->name("packages.create");
	Route::post("package/store", [PackageController::class, "store"])->name("packages.store");
	Route::get("package/edit/{id}", [PackageController::class, "edit"])->name("packages.edit");
	Route::post("package/update/{id}", [PackageController::class, "update"])->name("packages.update");
	Route::get("package/delete/{id}", [PackageController::class, "destroy"])->name("packages.destroy");

	Route::get("content/index", [ContentController::class, "index"])->name("contents.index");
	Route::get("content/create", [ContentController::class, "create"])->name("contents.create");
	Route::post("content/store", [ContentController::class, "store"])->name("contents.store");
	Route::get("content/edit/{id}", [ContentController::class, "edit"])->name("contents.edit");
	Route::post("content/update/{id}", [ContentController::class, "update"])->name("contents.update");
	Route::get("content/delete/{id}", [ContentController::class, "destroy"])->name("contents.destroy");
	Route::get("content/delete/{id}", [ContentController::class, "destroy"])->name("contents.destroy");
});


Route::get("/",function(){
	return view("main.index");
});


//
