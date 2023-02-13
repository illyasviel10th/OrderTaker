<?php

namespace App\Http\Controllers;
use App\Models\ViewPurchaseOrder;
use App\Models\PurchaseOrder;
use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PurchaseOrderController extends Controller
{
    public function index(){
        $purchaseorder = ViewPurchaseOrder::where('IsActive','=',1)
        ->get();
        return response()->json($purchaseorder);
        // return response()->json($customers);
    }

    public function store(){

        // $record = PurchaseOrder::where('Code', request('Code'))
        // // ->where('FullName', request('FullName'))
        // ->first();
        // if ($record) {
        //     return response()->json([
        //         'message' => 'A record with the same mobile number already exists.',
        //     ], 409);
        // }
        
        $datetime = Carbon::now();
        $datetoday = $datetime->toDateString();
        $dod =Carbon::parse(request('DateOfDelivery'))->format('Y-m-d');
       
        // $dateCreated = Carbon::createFromFormat('Y-m-d', );
        $PurchaseOrder = PurchaseOrder::create([
            'CustomerID'=>request('CustomerID'),
            'DateOfDelivery'=>$datetoday,
            'Status'=>request('Status'),
            'AmountDue'=>request('AmountDue'),
            'DateCreated'=>$datetoday,
            'CreatedBy'=>'Ryan Bathan',
            'UserID'=>'User-1',
            'IsActive'=>'1'
        ]);
        $purchaseItems = request('purchaseItems');
// 
       foreach($purchaseItems as $item){
        $PurchaseItem = PurchaseItem::create([
            'PurchaseOrderID'=>$PurchaseOrder->id,
            'SKUID'=>$item['id'],
            'Quantity'=>$item['quantity'],
            'Price'=>$item['Subtotal'],
            'UserID'=>'User-1',
         
        ]);
       }
       return response()->json([
                'message' => 'Order Processed!',
            ], 200);
    }
    


}
