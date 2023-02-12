<?php

namespace App\Http\Controllers;
use App\Models\sku;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SKUController extends Controller
{
    public function index (){
        $sku = sku::all();
        return response()->json($sku);
    }
}
