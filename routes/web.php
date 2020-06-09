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
            Route::group(['prefix' => '{merchandise_id}'], function () {
                // 商品單品資料修改
                Route::put('/', 'MerchandiseController@ItemUpdateProcess');
                // 商品清單檢視
                Route::get('/', 'MerchandiseController@ItemPage')
                    ->where(['merchandise_id' => '[0-9]+',]);

                Route::get('/edit', 'MerchandiseController@ItemEditPage');
            });
        });
        Route::get('/', 'MerchandiseController@OrderList');
        Route::post('/order','MerchandiseController@Order');
        Route::get('/make','TransactionController@MakeList')->name('make');
        Route::post('/ordered', 'TransactionController@MakeFinish');
    });

});


Auth::routes();

/*
// 商品
Route::group(['prefix' => 'merchandise'], function (){
    // 商品清單檢視
    Route::get('/', 'MerchandiseController@ListPage');
    Route::group(['middleware' => ['user.auth.admin']], function (){
        // 商品資料新增
        Route::get('/create', 'MerchandiseController@CreateProcess');
        // 商品管理清單檢視
        Route::get('/manage', 'MerchandiseController@ManageListPage');
    });


    //指定商品
    Route::group(['prefix' => '{merchandise_id}'], function (){
        // 商品清單檢視
        Route::get('/', 'MerchandiseController@ItemPage')
            ->where(['merchandise_id' => '[0-9]+',]);;
        // 商品單品編輯頁面檢視
        Route::get('/edit', 'MerchandiseController@ItemEditPage')
            ->middleware('user.auth.admin');
        // 商品單品資料修改
        Route::put('/', 'MerchandiseController@ItemUpdateProcess')
            ->middleware('user.auth.admin');
        // 購買商品
        Route::post('/buy', 'MerchandiseController@ItemBuyProcess')
            ->middleware('user.auth');
    });
});

// 交易
Route::get('/transaction', 'TransactionController@transactionListPage')
    ->middleware(['user.auth']);
*/
