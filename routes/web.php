<?php
//user side routes
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MartController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
//admin side routes
use App\Http\Controllers\UserTableController;
use App\Http\Controllers\admin\PostController;
//user side routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/booking',[BookingController::class,'index'])->name('booking');
Route::get('/mart',[MartController::class,'index'])->name('mart');
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
});
Route::any('/login-post', [LoginController::class, 'login'])->name('form.submit');
Route::get('/register.page', [LoginController::class, 'showRegisterForm'])->name('register.page');
Route::post('/store', [LoginController::class, 'store'])->name('user.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//admin side routes
Route::get('/user', [UserTableController::class, 'index'])->name('usertable');
Route::get('/users/{id}/edit', [UserTableController::class, 'edit'])->name('users.edit');
Route::delete('/users/{id}', [UserTableController::class, 'destroy'])->name('users.destroy');
//post routes
Route::get('/createpost', [PostController::class, 'create'])->name('post.create');
Route::post('/storepost', [PostController::class, 'store'])->name('post.store');
