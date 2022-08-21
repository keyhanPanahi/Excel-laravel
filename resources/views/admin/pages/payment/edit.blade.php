@extends('admin.layouts.master')

@section('title',' تنظیمات بانک ها - ویرایش بانک ها')

@section('content')
    <!-- Content -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}" class="text-primary">داشبورد</a></li>
        <li class="breadcrumb-item active ">ویرایش  بانک ها</li>
    </ul>
    <div class="card mb-4">
        <div class="card-body">
            <h3 class="pb-2 border-bottom mb-2 secondary-font">{{ $payment->name }} </h3>
            <br>
            <form action="{{ route('admin.payment.setting.update', $payment->id) }}" method="POST" id="formDisable">
                @csrf
                @method('PUT')
                <div class="row">

                    @if(array_key_exists('merchantId',json_decode($payment->detail,true)))
                        <div class="mb-3 col-md-6 " id="merchantId">
                            <label class="form-label" for="merchantId" id="label_merchantId">merchant Id </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="merchantId" id="merchantId" placeholder="merchantId را وارد کنید " value="{{ old('merchantId',json_decode($payment->detail)->merchantId) }}">
                            </div>
                            <div class="mt-1">
                                @error('merchantId')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if(array_key_exists('terminalId',json_decode($payment->detail,true)))
                        <div class="mb-3 col-md-6 " id="terminalId">
                            <label class="form-label" for="terminalId" id="label_terminalId">terminal Id </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="terminalId" id="terminalId" placeholder="terminalId را وارد کنید " value="{{ old('terminalId',json_decode($payment->detail)->terminalId) }}">
                            </div>
                            <div class="mt-1">
                                @error('terminalId')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if(array_key_exists('username',json_decode($payment->detail,true)))
                        <div class="mb-3 col-md-6 " id="username">
                            <label class="form-label" for="username" id="label_username">username </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="username" id="username" placeholder="username را وارد کنید " value="{{ old('username',json_decode($payment->detail)->username) }}">
                            </div>
                            <div class="mt-1">
                                @error('username')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if(array_key_exists('password',json_decode($payment->detail,true)))
                        <div class="mb-3 col-md-6 " id="password">
                            <label class="form-label" for="password" id="password">password </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="password" id="password" placeholder="password را وارد کنید " value="{{ old('password',json_decode($payment->detail)->password) }}">
                            </div>
                            <div class="mt-1">
                                @error('password')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if(array_key_exists('PaymentIdentity',json_decode($payment->detail,true)))
                        <div class="mb-3 col-md-6 " id="PaymentIdentity">
                            <label class="form-label" for="PaymentIdentity" id="PaymentIdentity">PaymentIdentity </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="PaymentIdentity" id="PaymentIdentity" placeholder="PaymentIdentity را وارد کنید " value="{{ old('PaymentIdentity',json_decode($payment->detail)->PaymentIdentity) }}">
                            </div>
                            <div class="mt-1">
                                @error('PaymentIdentity')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    @if(array_key_exists('key',json_decode($payment->detail,true)))
                        <div class="mb-3 col-md-6 " id="key">
                            <label class="form-label" for="key" id="key">key </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="key" id="key" placeholder="key را وارد کنید " value="{{ old('key',json_decode($payment->detail)->key) }}">
                            </div>
                            <div class="mt-1">
                                @error('key')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                     @endif

                        <br>
                    <div class="mb-3 col-md-12" id="status">
                        <label class="switch switch-success">
                            <input type="checkbox" class="switch-input" name="status" {{ old('status',$payment->status) ?  'checked' : '' }}>
                            <span class="switch-toggle-slider">
                                    <span class="switch-on">
                                         <i class="bx bx-check"></i>
                                    </span>
                                    <span class="switch-off">
                                        <i class="bx bx-x"></i>
                                    </span>
                                    </span>
                            <span class="switch-label">فعال سازی</span>
                        </label>
                    </div>

                    <div class="col-12 mt-1">
                        <button type="submit" class="btn btn-primary me-1" id="buttonDisable">ذخیره تغییرات</button>
                        <button type="reset" class="btn btn-label-secondary me-1">انصراف</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection

@section('page-js')
    {{-- disable submit button after request --}}
    <script>
        $('#formDisable').submit(function () {
            $('#buttonDisable').attr('disabled', true);
        });
    </script>
@endsection
