<?php

namespace App\Http\Controllers;

use App\Models\Admin\Payment\Bank;
use App\Models\Admin\Payment\PaymentSetting;
use App\Models\Membership\Organization;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request,Organization $organization)
    {
        if($request->ajax()){
            return DataTables::of(PaymentSetting::all())
                ->editColumn('bank_id', function (PaymentSetting $paymentSetting) {
                    return $paymentSetting->bank->name;
                })
                ->addColumn('is_default',function(PaymentSetting $paymentSetting){
                    if($paymentSetting->is_default == 1){
                        return '<span class="badge bg-label-primary">پیش فرض</span>';
                    } else{
                        return '<span class="badge bg-label-secondary">-</span>';
                    }
                })
                ->editColumn('status',function(PaymentSetting $paymentSetting){
                    if($paymentSetting->status == 0){
                        return '<span class="badge bg-label-danger">غیرفعال</span>';
                    } else{
                        return '<span class="badge bg-label-success">فعال</span>';
                    }
                })
                ->addColumn('action', function (PaymentSetting $paymentSetting) use ($organization) {
                    return view('admin.pages.payment.table.action', compact('paymentSetting', 'organization'));
                })
                ->rawColumns(['status','is_default'])
                ->make(true);
        }
        return view('admin.pages.payment.index',compact('organization'));
    }

    public function create(Organization $organization)
    {
        $banks = Bank::select('id','persian_name')->get();
        return view('admin.pages.payment.create',compact('organization','banks'));
    }

    public function store(Request $request)
    {
        $request->all();
    }

    public function edit(PaymentSetting $payment)
    {

        return view('admin.pages.payment.edit',compact('payment'));
    }
    public function update()
    {
//        return view('admin.pages.payment.edit');
    }

}
