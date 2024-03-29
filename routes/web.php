<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CheckoutController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/admin',[AdminController::class,'index']);
Route::get('/dashboard',[AdminController::class,'show_dasdboard']);
Route::get('/logout',[AdminController::class,'logout']);
//Danh mục sản phẩm ở trang chủ
Route::get('/chi-tiet-danh-muc/{id}',[CategoryProduct::class,'showCategoryHome']);
//tìm kiếm
Route::get('/tim-kiem',[HomeController::class,'search']);
Route::post('/add-product-search-to-cart',[HomeController::class,'AddProducSearchCart']);
Route::post('/timkiem-ajax',[HomeController::class,'autocomplete_ajax']);

Route::post('/admin-dashboard',[AdminController::class,'check_login']);

//category
Route::get('/show-category',[CategoryProduct::class,'showCategory']);
Route::get('/add-category',[CategoryProduct::class,'addCategory']);
Route::post('/save-category-product',[CategoryProduct::class,'saveCategory']);
Route::get('/undisplay-category-product/{id}',[CategoryProduct::class,'unDisplayCategory']);
Route::get('/display-category-product/{id}',[CategoryProduct::class,'displayCategory']);

Route::get('/edit-category-product/{id}',[CategoryProduct::class,'editCategory']);
Route::get('/delete-category-product/{id}',[CategoryProduct::class,'deleteCategory']);
Route::post('/update-category/{id}',[CategoryProduct::class,'updateCategory']);
Route::get('/search-category-admin',[CategoryProduct::class,'searchCategoryAdmin']);


//brand
Route::get('/show-brand',[BrandController::class,'showBrand']);
Route::get('/add-brand',[BrandController::class,'addBrand']);
Route::post('/save-brand',[BrandController::class,'saveBrand']);
Route::get('/undisplay-brand/{id}',[BrandController::class,'unDisplayBrand']);
Route::get('/display-brand/{id}',[BrandController::class,'displayBrand']);
Route::get('/edit-brand/{id}',[BrandController::class,'editBrand']);
Route::get('/delete-brand/{id}',[BrandController::class,'deleteBrand']);
Route::post('/update-brand/{id}',[BrandController::class,'updateBrand']);
Route::get('/search-brand-admin',[BrandController::class,'searchBrandAdmin']);
//Route::get('/update-brand/{id}', 'BrandController@updateBrand');



//supplier
Route::get('/show-supplier',[SupplierController::class,'showSupplier']);
Route::get('/add-supplier',[SupplierController::class,'addSupplier']);
Route::post('/save-supplier',[SupplierController::class,'saveSupplier']);
Route::get('/undisplay-supplier/{id}',[SupplierController::class,'unDisplaySupplier']);
Route::get('/display-supplier/{id}',[SupplierController::class,'displaySupplier']);
Route::get('/edit-supplier/{id}',[SupplierController::class,'editSupplier']);
Route::get('/delete-supplier/{id}',[SupplierController::class,'deleteSupplier']);
Route::post('/update-supplier/{id}',[SupplierController::class,'updateSupplier']);

//product-admin

Route::get('/show-product-admin',[ProductController::class,'showProduct']);
Route::get('/add-product-admin',[ProductController::class,'addProduct']);
Route::post('/save-product',[ProductController::class,'saveProduct']);
Route::get('/undisplay-product/{id}',[ProductController::class,'unDisplayProduct']);
Route::get('/display-product/{id}',[ProductController::class,'displayProduct']);
Route::get('/edit-product/{id}',[ProductController::class,'editProduct']);
Route::get('/delete-product/{id}',[ProductController::class,'deleteProduct']);
Route::post('/update-product/{id}',[ProductController::class,'updateProduct']);
Route::get('/search-product',[ProductController::class,'searchProduct']);


=======
Route::get('/show-product-admin',[ProductController::class,'index']);
Route::get('/add-product-admin',[ProductController::class,'create']);
Route::post('/save-product',[ProductController::class,'store']);
Route::get('/unstatus-product/{id}',[ProductController::class,'unStatusProduct']);
Route::get('/status-product/{id}',[ProductController::class,'statusProduct']);
Route::get('/unstate-product/{id}',[ProductController::class,'unStateProduct']);
Route::get('/state-product/{id}',[ProductController::class,'stateProduct']);
Route::get('/delete-product/{id}',[ProductController::class,'destroy']);
Route::get('/edit-product/{id}',[ProductController::class,'edit']);
Route::post('/update-product/{id}',[ProductController::class,'update']);
Route::get('/chi-tiet-san-pham/{id}',[ProductController::class,'detailProduct']);
Route::get('/search-product-admin',[ProductController::class,'searchProductAdmin']);
Route::post('/add-relative-to-cart',[ProductController::class,'AddRelativeProductCart']);

//cart
Route::get('/cart',[CartController::class,'showCart']);
Route::post('/add-to-cart',[CartController::class,'AddProductCart']);
Route::get('/delete-to-cart/{id}',[CartController::class,'DeleteProductCart']);
Route::post('/update-cart-quantity',[CartController::class,'UpdateQuantityCart']);
Route::get('/increment-cart-quantity/{id}',[CartController::class,'incrementQuantityCart']);
Route::get('/decrement-cart-quantity/{id}',[CartController::class,'decrementQuantityCart']);

//gallery
Route::get('/add-gallery/{id}',[GalleryController::class,'add_gallery']);
Route::post('/select-gallery',[GalleryController::class,'select_gallery']);
Route::post('/insert-gallery/{id}',[GalleryController::class,'insert_gallery']);
Route::post('/update-gallery-name',[GalleryController::class,'update_gallery_name']);
Route::post('/delete-gallery',[GalleryController::class,'delete_gallery']);
Route::post('/update-gallery',[GalleryController::class,'update_gallery']);
//Login
Route::get('/login-checkout',[CheckoutController::class,'loginCheckout']);

Route::get('/logout-checkout',[CheckoutController::class,'logoutCheckout']);
Route::get('/register-form',[CheckoutController::class,'registerCheckout']);
Route::get('/login-checkout-home',[CheckoutController::class,'loginCheckoutHome']);
Route::get('/register-form-hơm',[CheckoutController::class,'registerCheckout']);
Route::post('/add-customer-account',[CheckoutController::class,'addCustomerAccount']);
Route::post('/login-account',[CheckoutController::class,'loginAccount']);
Route::get('/checkout',[CheckoutController::class,'checkOut']);
Route::post('/save-checkout-customer',[CheckoutController::class,'saveCheckoutCustomer']);
