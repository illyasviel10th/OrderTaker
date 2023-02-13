<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::where('IsActive','=',1)
        ->orderBy('id','DESC')
        ->get();
        return response()->json($customers);
        // return response()->json($customers);
    }

    public function store(){

        $record = Customers::where('MobileNumber', request('MobileNumber'))
        // ->where('FullName', request('FullName'))
        ->first();
        if ($record) {
            return response()->json([
                'message' => 'A record with the same mobile number already exists.',
            ], 409);
        }
    
        $datetime = Carbon::now();
        $datetoday = $datetime->toDateString();
        // $dateCreated = Carbon::createFromFormat('Y-m-d', );
        return $customer = Customers::create([
            'FirstName'=>request('FirstName'),
            'LastName'=>request('LastName'),
            'FullName'=>request('FullName'),
            'MobileNumber'=>request('MobileNumber'),
            'DateCreated'=>$datetoday,
            'CreatedBy'=>'Ryan Bathan',
            'UserID'=>'User-1',
            'City'=>request('City'),
            'IsActive'=>'1'
        ]);

    }

    public function show($id){
        $customers = Customers::find($id);
        // return response()->json($customers);
        return $customers;

    }

    public function update(Customers $customer){
        return $customer->update([
            'FirstName'=>request('FirstName'),
            'LastName'=>request('LastName'),
            'FullName'=>request('FirstName').' '.request('LastName'),
            'MobileNumber'=>request('MobileNumber'),
            'City'=>request('City'),
            'IsActive'=>request('IsActive')
        ]);

    }
}
