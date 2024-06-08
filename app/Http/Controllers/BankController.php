<?php

namespace App\Http\Controllers;

use App\Models\BankModel;
use Illuminate\Http\Request;

class BankController extends Controller
{
    function bank(){
        $banks = BankModel::latest()->get();
        return view('backend.bank.bank', [
            'banks'=>$banks,
        ]);
    }

    function bank_store(Request $request){
       
        $request->validate([
        'bank_name'=>'required',
        'bank_address'=>'required',
       ]);

       BankModel::create([
        'bank_name'=>$request->bank_name,
        'bank_address'=>$request->bank_address,
       ]);  

       return back()->with('insert', 'New Bank Insert Successfully');
       
    }
}
