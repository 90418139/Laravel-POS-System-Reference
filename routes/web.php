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
// 登入
Route::any('login', function (){
    return view('auth.login');
});

Route::group(['prefix' => '/'], function (){
    Route::group(['middleware' => 'user.auth'], function (){
        Route::group(['prefix' => 'merchandise'], function (){
            // 建立商品
            Route::get('/create', 'MerchandiseController@CreateProcess');
            // 商品管理清單檢視
            Route::get('/manage', 'MerchandiseController@ManageListPage');
            Route::group(['prefix' => '{merchandise_id}'], function () {
                // 商品單品資料修改
                Route::put('/', 'MerchandiseController@ItemUpdateProcess');
                // 商品編輯
                Route::get('/edit', 'MerchandiseController@ItemEditPage');
            });
        });
        Route::get('/', 'MerchandiseController@OrderList');
        Route::post('/order','MerchandiseController@Order');
        Route::get('/make','TransactionController@MakeList')->name('make');
        Route::post('/ordered', 'TransactionController@MakeFinish');
        Route::get('/dashboard', 'HomeController@dashboard');
    });

});

// 停用使用者註冊功能
Auth::routes(['register' => false]);
