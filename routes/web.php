<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\registerController;
use App\Http\Controllers\frontend\LoginController;
use App\Http\Controllers\frontend\AdminController;
use App\Http\Controllers\admin\UserTableController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\CatagoryController;
use App\Http\Controllers\admin\BreedController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\AdminOrderController;
Route::get('/register',[registerController::class,'index'])->name('register');
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
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
    //ProductCategory routes

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
 
   Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name(name: 'products.edit');
   Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
   Route::delete('/deleteproduct/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
 
    //admin order
   Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
   Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
   Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

 //user routes
 Route::get('/user', [UserTableController::class, 'index'])->name('usertable');
 Route::get('/users/{id}/edit', [UserTableController::class, 'edit'])->name('users.edit');
 Route::delete('/users/{id}', [UserTableController::class, 'destroy'])->name('users.destroy');



});
Route::any('/login-post', [LoginController::class, 'login'])->name('form.submit');
Route::get('/register.page', [LoginController::class, 'showRegisterForm'])->name('register.page');
Route::post('/store', [LoginController::class, 'store'])->name('user.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');






















use App\Http\Controllers\UserSide\indexController;
use App\Http\Controllers\UserSide\UserProductController;
use App\Http\Controllers\UserSide\UserCartController;
use App\Http\Controllers\UserSide\UserOrderController;
Route::get('/', [indexController::class, 'index'])->name('home');
Route::get('/blog/{categoryId}', [indexController::class, 'petblog'])->name('category.posts');

Route::get('/breed/{categoryId}/{breedId}', [indexController::class, 'breedBlog'])->name('breed.posts');
Route::get('/post/{postId}', [indexController::class, 'singleBlog'])->name('single.post');


Route::get('/user-profile-view/{id}', [indexController::class, 'ViewProfile'])->name('userprofile.view');



Route::get('/category/{categoryId}/products', [UserProductController::class, 'getProductsByCategory']) ->name('category.products');

Route::get('/productcategory/{productcategoryId}/products', [UserProductController::class, 'getProductsByProductCategory'])->name('productcategories.products');

Route::middleware('auth')->group(function () {
    Route::get('cart', [UserCartController::class, 'index'])->name('cart.index');
    Route::post('cart/store', [UserCartController::class, 'store'])->name('cart.store');
    Route::post('cart/increase/{id}', [UserCartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::post('cart/decrease/{id}', [UserCartController::class, 'decreaseQuantity'])->name('cart.decrease');
    Route::delete('cart/remove/{id}', [UserCartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('cart/clear', [UserCartController::class, 'clearCart'])->name('cart.clear');
});
    Route::get('/checkout', [UserOrderController::class, 'checkoutForm'])->name('checkout.form');
    Route::get('/order/success', [UserOrderController::class, 'success'])->name('order.success');
    Route::post('/orders/checkout', [UserOrderController::class, 'checkout'])->name('checkout');
