<?php

namespace App\Http\Controllers;

use App\Models\Admin\Payment\PaymentSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            return DataTables::of(PaymentSetting::all())
                ->addColumn('is_default',function(PaymentSetting $paymentSetting){
                    if($paymentSetting->is_default == 1){
                        return '<span class="badge bg-label-primary">پیش فرض</span>';
                    } else{
                        return '<span class="badge bg-label-secondary">-</span>';
                    }                })
                ->editColumn('status',function(PaymentSetting $paymentSetting){
                    if($paymentSetting->status == 0){
                        return '<span class="badge bg-label-danger">غیرفعال</span>';
                    } else{
                        return '<span class="badge bg-label-success">فعال</span>';
                    }
                })
                ->addColumn('action','admin.pages.payment.table.action')
                ->rawColumns(['status','is_default' , 'action'])
                ->make(true);
        }
        return view('admin.pages.payment.index');
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
