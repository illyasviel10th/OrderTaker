<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SKUController;
use App\Http\Controllers\PurchaseOrderController;
use App\Models\Customer;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function (){
//     return view('dashboard');
// });

Route::get('{view}',ApplicationController::class)->where('view','(.*)');  

//Customer
Route::get('/api/customer',[CustomerController::class,'index']); 
Route::post('/api/customer',[CustomerController::class,'store']); 
Route::get('/api/customer/{id}',[CustomerController::class,'show']); 

//SKU
Route::get('/api/sku',[SKUController::class,'index']); 



//PurchaseOrder
Route::get('/api/purchaseorder',[PurchaseOrderController::class,'index']); 
// Route::get('/api/customer',function (){
//     return Customer::all();
// }); 