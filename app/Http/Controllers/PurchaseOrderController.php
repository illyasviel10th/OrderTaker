<?php

namespace App\Http\Controllers;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){
        $purchaseorder = PurchaseOrder::all();
        return response()->json($purchaseorder);
        // return response()->json($customers);
    }
}
