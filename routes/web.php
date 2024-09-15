<?php
//frontend routes
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\RegisterController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\BookingController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\MartController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\AdminController;
// user route
use App\Http\Controllers\admin\UserTableController;
//blog post routes
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\CatagoryController;
use App\Http\Controllers\admin\BreedController;
//frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/blogcategory/{id}',[BlogController::class,'showbycategory'])->name('blog.category');
Route::get('/blogsingle/{id}',[BlogController::class,'show'])->name('blog.readmore');
Route::get('/booking',[BookingController::class,'index'])->name('booking');
Route::get('/mart',[MartController::class,'index'])->name('mart');
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::get('/login',[LoginController::class,'index'])->name('login');

// admin middleware
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/update', [AdminController::class, 'update'])->name('admin.update');
    Route::get('/view', [AdminController::class, 'view'])->name('admin.view');

    //Pet Catagory routes
    Route::get('/indexcategory', [CatagoryController::class, 'index'])->name('Category.index');
    Route::get('/createcategory', [CatagoryController::class, 'create'])->name('Category.create');
    Route::any('/storecategory', [CatagoryController::class, 'store'])->name('Category.store');
    Route::get('/displaycategory', [CatagoryController::class, 'viewcategory'])->name('Category.display');
    Route::get('/editcategory/{id}', [CatagoryController::class, 'edit'])->name('Category.edit');
    Route::put('/categories/{id}', [CatagoryController::class, 'update'])->name('Category.update');
    Route::delete('/destroycategory/{id}', [CatagoryController::class, 'destroy'])->name('Category.destroy');

    //Pet Breed routes
    Route::get('/createbreed', [BreedController::class, 'create'])->name('breed.create');
    Route::any('/storebreed', [BreedController::class, 'store'])->name('breed.store');
    Route::any('/displaybreed', [BreedController::class, 'viewbreed'])->name('breed.view');
    Route::any('/indexbreed', [BreedController::class, 'index'])->name('breed.index');
    Route::get('/breed/{id}/edit', [BreedController::class, 'edit'])->name('breed.edit');
    Route::put('/breed/{id}/update', [BreedController::class, 'update'])->name('breed.update');
    Route::delete('/breed/{id}', [BreedController::class, 'destroy'])->name('breed.destroy');

    //post routes
    Route::get('/indexpost', [PostController::class, 'index'])->name('post.index');
    Route::get('/createpost', [PostController::class, 'create'])->name('post.create');
    Route::post('/storepost', [PostController::class, 'store'])->name('post.store');
    Route::get('/viewpost', [PostController::class, 'viewpost'])->name('post.view');
    Route::get('/get-breeds/{catagory_id}', [PostController::class, 'getBreeds']);
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('post.update');
    Route::any('/deletepost/{id}',[PostController::class,'destroy'])->name('post.destroy');


    //user routes
    Route::get('/user', [UserTableController::class, 'index'])->name('usertable');
    Route::get('/users/{id}/edit', [UserTableController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{id}', [UserTableController::class, 'destroy'])->name('users.destroy');
});
Route::any('/login-post', [LoginController::class, 'login'])->name('form.submit');
Route::get('/register.page', [LoginController::class, 'showRegisterForm'])->name('register.page');
Route::post('/store', [LoginController::class, 'store'])->name('user.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



use App\Http\Controllers\ChatBotController;
Route::match(['get', 'post'], '/botman', [ChatBotController::class, 'handle']);
Route::get('/debug-env', function () {
    return env('OPENAI_API_KEY');
});