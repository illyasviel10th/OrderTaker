<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::where('IsActive','=',1)->get();
        return response()->json($customers);
        // return response()->json($customers);
    }

    public function store(){
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
