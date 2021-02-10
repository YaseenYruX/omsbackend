<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\QuotesController;
use App\Http\Controllers\Api\BrandsController;
use App\Http\Controllers\Api\QuotesitemController;
use App\Http\Controllers\Api\purchaser\QuotesController as PurchaserQuotesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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