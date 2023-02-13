<?php

namespace App\Http\Controllers;
use App\Models\sku;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SKUController extends Controller
{
    public function index (){
        $skus = sku::where('IsActive','=',true)
        ->orderBy('id','DESC')
        ->get();
        return response()->json($skus);
    }

    public function store(){

        $record = sku::where('Code', request('Code'))
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
        return $sku = sku::create([
            'Name'=>request('Name'),
            'Code'=>request('Code'),
            'UnitPrice'=>request('UnitPrice'),
            'DateCreated'=>$datetoday,
            'CreatedBy'=>'Ryan Bathan',
            'UserID'=>'User-1',
            'IsActive'=>'1'
        ]);

    }

    public function show($id){
        $skus = sku::find($id);
        // return response()->json($skus);
        return $skus;

    }

    public function update(sku $sku){
        return $sku->update([
            'Name'=>request('Name'),
            'Code'=>request('Code'),
            'UnitPrice'=>request('UnitPrice'),
            'IsActive'=>request('IsActive')
        ]);

    }
}
