<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::all();
        return response()->json($customers);
        // return response()->json($customers);
    }

    public function store(){
        $datetime = Carbon::now();
        $datetoday = $datetime->toDateString();
        // $dateCreated = Carbon::createFromFormat('Y-m-d', );
        return $customer = Customers::create([
            'FirstName'=>request('firstname'),
            'LastName'=>request('lastname'),
            'FullName'=>request('fullname'),
            'MobileNumber'=>request('mobilenumber'),
            'DateCreated'=>$datetoday,
            'CreatedBy'=>'Ryan Bathan',
            'UserID'=>'User-1',
            'City'=>request('city'),
            'IsActive'=>'1'
        ]);

    }

    public function show($id){
        $customers = Customers::find($id);
        return response()->json($customers);

    }
}
