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
                ->editColumn('name',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->name;
                })
                ->addColumn('username',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->uesrname ?? '-';
                })
                ->addColumn('password',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->password ?? '-';
                })
                ->addColumn('merchant_id',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->merchant_id ?? '-';
                })
                ->addColumn('terminal_id',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->terminal_id ?? '-';
                })
                ->addColumn('key',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->key ?? '-';
                })
                ->addColumn('PaymentIdentity',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->PaymentIdentity ?? '-';
                })
                ->addColumn('paymentSetting',function(PaymentSetting $paymentSetting){
                    return $paymentSetting->paymentSetting ?? '-';
                })
                ->editColumn('status',function(PaymentSetting $paymentSetting){
                    if($paymentSetting->status == 0){
                        return '<span class="badge bg-label-danger">غیرفعال</span>';
                    }
                    elseif($paymentSetting->status == 1){
                        return '<span class="badge bg-label-success">فعال</span>';
                    }else{
                        return '<span class="badge bg-label-primary">پیش فرض فعال</span>';
                    }
                })
                ->addColumn('action','admin.pages.payment.table.action')
                ->rawColumns(['status' , 'action'])
                ->make(true);
        }
        return view('admin.pages.payment.index');
    }

    public function edit()
    {
        return view('admin.pages.payment.edit');
    }
    public function update()
    {
//        return view('admin.pages.payment.edit');
    }

}
