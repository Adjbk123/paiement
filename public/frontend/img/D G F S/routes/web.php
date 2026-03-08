<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Facade;
use App\Http\Controllers\categorycontroller;

//Route::get('/', function () {
   // return view('welcome');
//});

Auth::routes();

route::controller(App\Http\Controllers\Frontend\FrontendController::class)->group(function(){ 

    route::get('/','index');
    route::get('/collections','categories');

    route::get('/collections/{category_slug}','products');
    route::get('/collections/{category_slug}/{product_slug}' ,  'productView');

    route::get('/new-arrivals','newArrrival');
    route::get('/featured-products','featuredproducts');
    route::get('search' , 'searchProducts');
    Route::get('connexion' , 'connexion');
    Route::get('about' ,  'about');

});  


Route::middleware(['auth'])->group(function(){

    Route::get('wishlist',[App\Http\Controllers\Frontend\WishlistController::class, 'index']);
    Route::get('cart',[App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::get('checkout',[App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::get('orders',[App\Http\Controllers\Frontend\OderController::class, 'index']);
    Route::get('orders/{orderId}',[App\Http\Controllers\Frontend\OderController::class, 'show']);
    Route::get('profile' , [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::post('profile', [App\Http\Controllers\Frontend\UserController::class, 'updateUserDetails']);
    Route::get('change-password' , [App\Http\Controllers\Frontend\UserController::class, 'changepassword']);
    Route::post('change-password' , [App\Http\Controllers\Frontend\UserController::class, 'changepasswords']);
    
});

route::get('thank-you',[App\Http\Controllers\Frontend\FrontendController::class, 'thankyou']);

Route::get('/greeting/{locale}', function ($locale){
    if(! in_array($locale, ['fr', 'es', 'fr'])){
        abort(400);
    }
    App::setLocale($locale);
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function(){

    route::get('dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);
    route::get('settings' , [App\Http\Controllers\Admin\StettingController::class, 'index' ]);
    route::post('settings', [App\Http\Controllers\Admin\StettingController::class, 'store']);

    route::controller(App\Http\Controllers\Admin\SliderController::class)->group(function(){
        route::get('sliders' , 'index');
        route::get('sliders/create' , 'create');
        route::post('sliders/create' , 'store');

    });
    //category routes
    route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function(){

        route::get('/category', 'index');
        route::get('/category/create', 'create');
        route::post('/category', 'store');
        route::get('/category/{category}/edit', 'edit');
        route::put('/category/{categoty}', 'update');
    });
    route::controller(App\Http\Controllers\Admin\productcontroller::class)->group(function(){

        route::get('/products', 'index');
        route::get('products/create' , 'create');
        route::post('/products', 'store');
        route::get('/products/{product}/edit', 'edit');
        route::put('/products/{product}', 'update');
        route::get('products/{product_id}/delete', 'destroy');
        route::get('product-image/{product_image_id}/delete' , 'destroyImage');

    });

    route::controller(App\Http\Controllers\Admin\RecetteControllers::class)->group(function(){

        route::get('/recette', 'index');
        route::get('recette/create' , 'create');
        route::post('/recette', 'store');
        route::get('/recette/{recette}/edit', 'edit');
        route::put('/recette/{recette}', 'update');
        route::get('recette/{recette_id}/delete', 'destroy');
        route::get('recette/invoice', 'invoice');
        route::get('recette/generateInvoice', 'generateInvoice');
       

    });
    route::controller(App\Http\Controllers\Admin\depenseControllers::class)->group(function(){

        route::get('/depense', 'index');
        route::get('depense/create' , 'create');
        route::post('/depense', 'store');
        route::get('/depense/{depense}/edit', 'edit');
        route::put('/depense/{depense}', 'update');
        route::get('depense/{depense_id}/delete', 'destroy');
        route::get('depense/invoice', 'invoice');
        route::get('depense/generateInvoice', 'generateInvoice');
        
       

    });

    route::controller(App\Http\Controllers\Admin\SyntheseContrllers::class)->group(function(){

        route::get('/synthese', 'index');
        route::get('synthese/invoice', 'invoice');
        route::get('synthese/generateInvoice', 'generateInvoice');
        
       

    });
   

    route::controller(App\Http\Controllers\Admin\OrderController::class)->group(function(){

        route::get('/orders', 'index');
        route::get('/orders/{orderId}', 'show');
        route::put('/orders/{orderId}', 'updateOrderStatus');

        Route::get('/invoice/{orderId}', 'viewInvoice');
        Route::get('/invoice/{orderId}/generate', 'generateInvoice');
       
        
    }); 
    
    route::controller(App\Http\Controllers\Admin\UserController::class)->group(function(){

        route::get('/users', 'index');
        route::get('/users/create', 'create');

        route::post('/users' , 'store' );
        route::get('/users/{user_id}/edit' , 'edit');
        route::put('users/{user_id}' , 'update');
        route::get('users/{user_id}/delete' , 'destroy');

    });
});






















