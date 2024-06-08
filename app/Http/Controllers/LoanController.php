<?php

namespace App\Http\Controllers;

use App\Models\BankModel;
use App\Models\Loan;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    function loan(){
        $banks = BankModel::all();
        $users = UserModel::all();
        $loans = Loan::latest()->get();
        return view('backend.loan.loan', [
            'banks'=>$banks,
            'users'=>$users,
            'loans'=>$loans,
        ]);
    }

    public function showUserInfo($id)
    {
        $user = UserModel::find($id);

        // You may want to return JSON or a view depending on your requirements
        return response()->json($user);
    }


    public function loan_calculate(Request $request)
    {
        $amount = $request->input('amount');
        $duration = $request->input('duration');
        $percentage = $request->input('percentage');


        $perMonth = $amount / $duration;
        $interest = $amount * ($percentage / 100);
        $monthly = $perMonth + $interest ;
        $total =  $amount + ($interest * $duration);

        

        $data = [
            'total'=>$total,
            'monthly'=>$monthly,
        ];

        return response()->json($data);
    }

    function loan_store(Request $request){

        Loan::insert([
            'bank_id'=>$request->bank_id,
            'user_id'=>$request->user_id,
            'loan_amount'=>$request->amount,
            'duration'=>$request->duration,
            'percentage'=>$request->percentage,
            'total_payable'=>$request->total_payable,
            'monthly_payable'=>$request->monthly_payable,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('created', 'Loan Created Successfully');

    }

    function loan_history(){

        $banks = BankModel::all();
        $users = UserModel::all();
        return view('backend.loan.loan_history', [
            'banks'=>$banks,
            'users'=>$users,
        ]);
    }
    

    public function showUserLoan($id)
    {
        $user = Loan::where('user_id',$id)->get()->first();

        // You may want to return JSON or a view depending on your requirements
        return response()->json($user);
    }
    
}
