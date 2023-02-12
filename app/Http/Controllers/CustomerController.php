<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;
class CustomerController extends Controller
{
    public function index(){
        $customers = Customers::latest()->get();

        return response()->json($customers);
    }
}
