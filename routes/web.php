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
//blog post routes
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\CatagoryController;
use App\Http\Controllers\admin\BreedController;
 // Community Post Routes
use App\Http\Controllers\admin\CommunitypostControllers\ThreadController;
use App\Http\Controllers\admin\CommunitypostControllers\CommunityPostController;
use App\Http\Controllers\admin\CommunitypostControllers\ReplyController;
use App\Http\Controllers\admin\CommunitypostControllers\ReactionController;
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
//Pet Catagory routes
    Route::get('/indexcatagory', [CatagoryController::class, 'index'])->name('Catagory.index');
    Route::get('/createcatagory', [CatagoryController::class, 'create'])->name('Catagory.create');
    Route::any('/storecatagory', [CatagoryController::class, 'store'])->name('Catagory.store');
    Route::get('/displaycatagory', [CatagoryController::class, 'viewcatagory'])->name('Catagory.display');
    Route::get('/editcatagory/{id}', [CatagoryController::class, 'edit'])->name('Catagory.edit');
    Route::delete('/destroycatagory/{id}', [CatagoryController::class, 'destroy'])->name('Catagory.destroy');


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

//Pet Breed routes
Route::get('/createbreed', [BreedController::class, 'create'])->name('breed.create');
Route::any('/storebreed', [BreedController::class, 'store'])->name('breed.store');
    // Community Post Routes
    // Thread Routes
    Route::get('/threadsindex', [ThreadController::class, 'index'])->name('threads.index');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
    Route::delete('/threads/{thread}', [ThreadController::class, 'destroy'])->name('threads.destroy');

    // CommunityPost Routes
    Route::post('/threads/{thread}/community-posts', [CommunityPostController::class, 'store'])->name('communityposts.store');
    Route::delete('/community-posts/{communityPost}', [CommunityPostController::class, 'destroy'])->name('communityposts.destroy');

    // Reply Routes
    Route::post('/community-posts/{communityPost}/replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
