<?php
use App\Models\Customers;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SKUController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Route::get('/api/customers',function(){
//     return Customers::all();
// });
// Route::get('/customerlist',[CustomerController::class,'index']); 
Route::resource('customer',App\Http\Controllers\CustomerController::class)
->only(['index','store','show','update','destroy']);

Route::resource('sku',App\Http\Controllers\SKUController::class)
->only(['index','store','show','update','destroy']);

Route::resource('purchaseorder',App\Http\Controllers\PurchaseOrderController::class)
->only(['index','store','show','update','destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
