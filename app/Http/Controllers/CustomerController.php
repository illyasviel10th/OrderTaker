<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::all();
        return response()->json($customers);
        // return response()->json($customers);
    }
}
