<?php

namespace App\Http\Controllers;

use App\Models\Admin\Payment\Bank;
use App\Models\Admin\Payment\PaymentSetting;
use App\Models\Membership\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request,Organization $organization)
    {
        if($request->ajax()){
            return DataTables::of(PaymentSetting::all())
                ->editColumn('bank_id', function (PaymentSetting $paymentSetting) {
                    return $paymentSetting->bank->persian_name;
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
        $paymentSetting=PaymentSetting::select('bank_id')->get();
        $banks = Bank::where('status',1)->whereNotIn('id',$paymentSetting)->get();
        return view('admin.pages.payment.create',compact('organization','banks'));
    }

    public function store(Request $request,Organization $organization)
    {
        $inputs =$request->all();
        $inputs['organization_id'] = Auth::user()->organization->id;
        $request->status == 'on' ? $inputs['status']=1 : $inputs['status']=0 ;
        if($inputs['bank_id'] == 1){
            unset($inputs['username'],$inputs['password']);
        }
        elseif($inputs['bank_id'] == 2){
            unset($inputs['merchantId'],$inputs['key'],$inputs['PaymentIdentity']);
        }
        elseif($inputs['bank_id'] == 6){
            unset($inputs['terminalId'],$inputs['key'],$inputs['PaymentIdentity']);
        }
        elseif($inputs['bank_id'] == 7){
            unset($inputs['username'],$inputs['password'],$inputs['key'],$inputs['PaymentIdentity']);
        }
        elseif($inputs['bank_id'] == 3||4||5||8){
            unset($inputs['username'],$inputs['password'],$inputs['terminalId'],$inputs['key'],$inputs['PaymentIdentity']);
        }

        $detail = Arr::except($inputs,['organization_id','bank_id','status','_token']);
        $inputs['detail'] =json_encode($detail);
        $payment_setting = PaymentSetting::create($inputs);
        return to_route('admin.membership.organization.payment.setting.index',compact('organization'))->with('toast-success', 'درگاه با موفقیت ایجاد گردید.');

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
