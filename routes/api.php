<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\QuotesController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\QuotesitemController;
use App\Http\Controllers\Api\purchaser\QuotesController as PurchaserQuotesController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;

/*cu in routes mean it's for create and update*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*login route*/
Route::name('authenticate.')->prefix('auth')->middleware('cors')->group(function () {
	Route::post('/login', [AuthController::class, 'login'])->name('login');
});
/*login route end*/
/*authenticated routes*/
Route::name('auth.')->prefix('auth')->middleware(['cors','auth:api'])->group(function () {
	Route::name('admin.')->prefix('admin')->middleware('admin')->group(function () {
		Route::get('/users', [AdminUserController::class, 'index'])->name('users');
		Route::get('/user/{user}', [AdminUserController::class, 'get'])->name('user.get');
		Route::post('/user-cu/{user?}', [AdminUserController::class, 'cu'])->name('user.cu');
		Route::delete('/user/{user}', [AdminUserController::class, 'delete'])->name('user.delete');
		Route::get('/users-summary',[AdminUserController::class,'user_summary'])->name('user.summary');
	});
	Route::name('buh.')->prefix('buh')->middleware('buh')->group(function () {
		
	});
	Route::name('sales.')->prefix('sales')->middleware('sales')->group(function () {
		
	});
	Route::name('purchaser.')->prefix('purchaser')->middleware('purchaser')->group(function () {
		
	});
});
/*authenticated routes end*/
Route::name('leads.')->prefix('leads')->middleware('cors')->group(function () {
	Route::get('/', [LeadController::class, 'index'])->name('list');
	Route::post('/create-update/{lead?}', [LeadController::class, 'create_or_update'])->name('createupdate');
	Route::get('/delete/{lead}', [LeadController::class, 'delete'])->name('delete');
	Route::get('/get/{lead}', [LeadController::class, 'get'])->name('get');
});

Route::name('brands.')->prefix('brands')->middleware('cors')->group(function () {
	Route::get('/', [BrandsController::class, 'index'])->name('list');
	Route::post('/create-update/{brands?}', [BrandsController::class, 'create_or_update'])->name('createupdate');
	Route::get('/delete/{brands}', [BrandsController::class, 'delete'])->name('delete');
	Route::get('/get/{brands}', [BrandsController::class, 'get'])->name('get');
});



Route::name('quotes.')->prefix('quotes')->middleware('cors')->group(function () {
	Route::get('/', [QuotesController::class, 'index'])->name('list');
	Route::post('/create-update/{quotes?}', [QuotesController::class, 'create_or_update'])->name('createupdate');
	Route::get('/delete/{quotes}', [QuotesController::class, 'delete'])->name('delete');
	Route::get('/get/{quotes}', [QuotesController::class, 'get'])->name('get');
});

Route::name('quotes-item.')->prefix('quotesitem')->middleware('cors')->group(function () {
	Route::get('/', [QuotesitemController::class, 'index'])->name('list');
	Route::post('/create-update/{quotes?}', [QuotesitemController::class, 'create_or_update'])->name('createupdate');
	Route::get('/delete/{quotes}', [QuotesitemController::class, 'delete'])->name('delete');
	Route::get('/get/{quotes}', [QuotesitemController::class, 'get'])->name('get');
});

Route::name('purchaser.')->prefix('purchaser')->middleware('cors')->group(function () {
	Route::get('/unanswered', [PurchaserQuotesController::class, 'unanswered'])->name('unanswered');
	Route::post('/quote/giveprice/{quotes_item}', [PurchaserQuotesController::class, 'itemquote'])->name('itemquote');
	Route::post('/multiquote/giveprice/{quotes_item}', [PurchaserQuotesController::class, 'multiitemquote'])->name('itemquote');
});

Route::name('admin.')->prefix('admin')->middleware('cors')->group(function () {
	Route::get('/login', [PurchaserQuotesController::class, 'login'])->name('login');
	Route::post('/quote/giveprice/{quotes_item}', [PurchaserQuotesController::class, 'itemquote'])->name('itemquote');
	Route::post('/multiquote/giveprice/{quotes_item}', [PurchaserQuotesController::class, 'multiitemquote'])->name('itemquote');
});
