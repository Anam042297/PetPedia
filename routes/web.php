<?php
//frontend routes
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\registerController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\BlogController;
use App\Http\Controllers\frontend\MartController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\AdminController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\OrderController;
// user route
use App\Http\Controllers\admin\UserTableController;
//blog post routes
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\CatagoryController;
use App\Http\Controllers\admin\BreedController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\AdminOrderController;

//frontend routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog',[BlogController::class,'index'])->name('blog');
Route::get('/blogcategory/{id}',[BlogController::class,'showbycategory'])->name('blog.category');
Route::get('/blogsingle/{id}',[BlogController::class,'show'])->name('blog.readmore');
Route::get('/mart',[MartController::class,'index'])->name('mart');
Route::get('/about',[AboutController::class,'index'])->name('about');
Route::get('/register',[registerController::class,'index'])->name('register');
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
//ProductPetCategory routes

    Route::get('/indexproductcategories', [ProductCategoryController::class, 'index'])->name('ProductCategory.index');
    Route::get('/createproductcategories', [ProductCategoryController::class, 'create'])->name('ProductCategory.create');
    Route::any('/storeproductcategories', [ProductCategoryController::class, 'store'])->name('ProductCategory.store');
    Route::get('/displayproductcategories', [ProductCategoryController::class, 'viewcategory'])->name('ProductCategory.display');
    Route::get('/editproductcategories/{id}', [ProductCategoryController::class, 'edit'])->name('ProductCategory.edit');
    Route::put('/productcategories/{id}', [ProductCategoryController::class, 'update'])->name('ProductCategory.update');
    Route::delete('/destroyproductcategories/{id}', [ProductCategoryController::class, 'destroy'])->name('ProductCategory.destroy');
    
   //product routes
   Route::any('/indexproduct', [ProductController::class, 'index'])->name('products.index');
   Route::get('/createproduct', [ProductController::class, 'create'])->name('products.create');
   Route::post('/storeproduct', [ProductController::class, 'store'])->name('products.store');
   Route::get('/get-product_category/{petcategory_id}', [ProductController::class, 'getproduct_category']);
   Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name(name: 'products.edit');
   Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
 Route::get('/product/{id}', [ProductController::class, 'showProductPage'])->name('product.page');
   Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
   Route::put('/martproduct/{id}', [ProductController::class, 'update'])->name('products.show');

   Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');

 //user routes
 Route::get('/user', [UserTableController::class, 'index'])->name('usertable');
 Route::get('/users/{id}/edit', [UserTableController::class, 'edit'])->name('users.edit');
 Route::delete('/users/{id}', [UserTableController::class, 'destroy'])->name('users.destroy');


});
Route::any('/login-post', [LoginController::class, 'login'])->name('form.submit');
Route::get('/register.page', [LoginController::class, 'showRegisterForm'])->name('register.page');
Route::post('/store', [LoginController::class, 'store'])->name('user.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


  Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
  Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
  Route::patch('/cart/update/{id}', [CartController::class, 'updateCartItem'])->name('cart.update');
  Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
  Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
   
 
  Route::get('/checkout', [OrderController::class, 'checkoutForm'])->name('checkout.form');
  Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

Route::group(['middleware' => 'auth'], function () {
  // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
  Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('checkout');
});



use App\Http\Controllers\ChatBotController;
Route::match(['get', 'post'], '/botman', [ChatBotController::class, 'handle']);
Route::get('/debug-env', function () {
    return env('OPENAI_API_KEY');
});