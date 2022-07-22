<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\Generalsetting;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;

class DepositController extends Controller
{
    public function datatables()
    {
        $datas = Deposit::orderBy('id','desc');  

        return Datatables::of($datas)
                        ->editColumn('created_at', function(Deposit $data) {
                            $date = date('d-m-Y',strtotime($data->created_at));
                            return $date;
                        })
                        ->addColumn('customer_name',function(Deposit $data){
                            $data = User::where('id',$data->user_id)->first();
                            return $data->name;
                        })
                        ->addColumn('customer_email',function(Deposit $data){
                            $data = User::where('id',$data->user_id)->first();
                            return $data->email;
                        })
                        ->editColumn('amount', function(Deposit $data) {
                            $gs = Generalsetting::find(1);
                            $defaultCurrency = Currency::where('is_default',1)->first();
                            return $defaultCurrency->sign.round($data->amount*$defaultCurrency->value);
                        })
                        ->editColumn('status', function(Deposit $data) {
                            $status = $data->status == 'pending' ? '<span class="badge badge-warning">pending</span>' : '<span class="badge badge-success">completed</span>';
                            return $status;
                        })
                        ->rawColumns(['created_at','customer_name','customer_email','amount','status'])
                        ->toJson();
    }

    public function index(){
        return view('admin.deposit.index');
    }
}
