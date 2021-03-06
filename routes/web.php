<?php

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

    Route::get('/', 'HomeController@index');
    Route::get('/all-products', 'HomeController@products');
    Route::get('/all-products/category/{id}', 'HomeController@category');
    Route::get('/product/{id}', 'HomeController@showprod');    

    Route::group(['middleware' => ['auth','user']], function(){
        Route::get('/my-orders', 'HomeController@myorder');    
        Route::get('/add-cart/{id}', 'CartController@addToCart');    
        Route::get('/cart', 'CartController@index');    
        Route::get('/reduceqty/{id}', 'CartController@getReduce');    
        Route::get('/addqty/{id}', 'CartController@getAdd');    
        Route::get('/remove/{id}', 'CartController@getRemove');    
        Route::get('/checkout', 'CartController@getcheckout');    
        Route::post('/checkout', 'CartController@checkout');    
        Route::post('/review/comment', 'ReviewController@store'); 
        Route::delete('/review/delete/{id}', 'ReviewController@delete'); 
    });

Route::group(['middleware' => ['auth','admin']], function(){
    Route::get('/admin', 'AdminController@index');

    Route::get('/users', 'AdminController@users');
    Route::get('/users-edit/{id}', 'AdminController@edituser');
    Route::put('/user-update/{id}', 'AdminController@updateuser');
    Route::delete('/user-delete/{id}', 'AdminController@deleteuser');
    Route::get('/aorders', 'AdminController@orders');
    Route::get('/aprofile', 'AdminController@profile');
    Route::get('/aprofile-edit/{id}', 'AdminController@editprofile');
    Route::put('/aprofile-update/{id}', 'AdminController@updateprofile');

    Route::get('/prodlist', 'AdminController@prodlist');
    Route::get('/prodlist/{id}', 'AdminController@show');

});
Route::group(['middleware' => ['auth','designer']], function(){
    Route::get('/designer', 'DesignerController@index');
    Route::delete('/user-delete/{id}', 'DesignerController@deleteuser');
    Route::get('/profile', 'DesignerController@profile');
    Route::get('/profile-edit/{id}', 'DesignerController@editprofile');
    Route::put('/profile-update/{id}', 'DesignerController@updateprofile');
    Route::get('/orders', 'DesignerController@orders');
    Route::get('/tasks', 'DesignerController@tasks');
    Route::resource('products', 'ProductController');  
    Route::get('/products/delete/{id}', 'ProductController@destroy');
});

Auth::routes();