<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'product_id' => 'required|integer',
            'qty' => 'required|integer',
        ]);
        $data = $request->all();

        if ($request->ajax()) {
            return response()->json([
                'answer' => 'success',
                'id' => $data['product_id'],
                'qty' => $data['qty'],
            ]);
        } else {
            dd($data);
        }
    }
    
    
    
}
