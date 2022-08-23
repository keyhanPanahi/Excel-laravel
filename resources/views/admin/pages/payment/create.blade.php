@extends('admin.layouts.master')

@section('title',' تنظیمات پرداخت - ایجاد درگاه پرداخت')

@section('content')
    <!-- Content -->
    <ul class="breadcrumb">
        <li class="breadcrumb-item "><a href="{{ route('admin.dashboard') }}" class="text-primary">داشبورد</a></li>
        <li class="breadcrumb-item active "> ایجاد درگاه پرداخت</li>
    </ul>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.membership.organization.payment.setting.store',$organization->id) }}" method="POST" id="formDisable">
                @csrf
                <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="bank_id" class="form-label">انتخاب نوع درگاه</label>
                            <select id="bank_id" class="form-select" name="bank_id"  onchange="myFunction()">
                                @foreach ($banks as $bank)
                                <option value="{{$bank->id}}"
                                        {{$bank->id == old('bank_id') ? 'selected' : ''}}
                                    >{{ $bank->persian_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-1">
                            @error('bank_id')
                            <span class="text-danger"> * {{ $message }}</span>
                            @enderror
                        </div>
                    <hr>
                        <div class="mb-3 col-md-6 d-none" id="divMerchantId">
                            <label class="form-label" for="merchantId" id="label_merchantId">merchant Id </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="merchantId" id="merchantId" placeholder="merchantId را وارد کنید " value="{{ old('merchantId') }}">
                            </div>
                            <div class="mt-1">
                                @error('merchantId')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 d-none" id="divTerminalId">
                            <label class="form-label" for="terminalId" id="label_terminalId">terminal Id </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="terminalId" id="terminalId" placeholder="terminalId را وارد کنید " value="{{ old('terminalId') }}">
                            </div>
                            <div class="mt-1">
                                @error('terminalId')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 d-none" id="divUsername">
                            <label class="form-label" for="username" id="label_username">username </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="username" id="username" placeholder="username را وارد کنید " value="{{ old('username') }}">
                            </div>
                            <div class="mt-1">
                                @error('username')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 d-none" id="divPassword">
                            <label class="form-label" for="password" id="password">password </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="password" id="password" placeholder="password را وارد کنید " value="{{ old('password') }}">
                            </div>
                            <div class="mt-1">
                                @error('password')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 d-none" id="divPaymentIdentity">
                            <label class="form-label" for="PaymentIdentity" id="PaymentIdentity">PaymentIdentity </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="PaymentIdentity" id="PaymentIdentity" placeholder="PaymentIdentity را وارد کنید " value="{{ old('PaymentIdentity') }}">
                            </div>
                            <div class="mt-1">
                                @error('PaymentIdentity')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 d-none" id="divKey">
                            <label class="form-label" for="key" id="key">key </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="key" id="key" placeholder="key را وارد کنید " value="{{ old('key') }}">
                            </div>
                            <div class="mt-1">
                                @error('key')
                                <span class="text-danger"> * {{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    <br>
                    <div class="mb-3 col-md-12 " id="status">
                        <label class="switch switch-success">
                            <input type="checkbox" class="switch-input" name="status" {{ old('status') ?  'checked' : '' }}>
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

    <!-- change view-->
    <script>
        window.onload = myFunction();
        function myFunction(){
            let number = Number(document.getElementById('bank_id').value);
            console.log(number)
            if (number == 1 || number == 3 || number == 4 || number == 6 || number == 7 || number == 8 ){
                document.getElementById('divMerchantId').classList.remove('d-none');
            }
            if (number == 2 || number == 5){
                document.getElementById('divMerchantId').classList.add('d-none');
            }
            if (number == 1 || number == 2 || number == 5 || number == 7){
                document.getElementById('divTerminalId').classList.remove('d-none');
            }
            if (number == 3 ||  number == 4 || number == 6 || number == 8){
                document.getElementById('divTerminalId').classList.remove('d-none');
            }
            if (number == 3 ||  number == 4 || number == 6 || number == 8){
                document.getElementById('divTerminalId').classList.add('d-none');
            }
            if (number == 2 || number == 6){
                document.getElementById('divUsername').classList.remove('d-none');
                document.getElementById('divPassword').classList.remove('d-none');

            }
            if (number == 1 ||  number == 3 || number == 4 || number == 5 || number == 7){
                document.getElementById('divUsername').classList.add('d-none');
                document.getElementById('divPassword').classList.add('d-none');

            }
            if (number == 1){
                document.getElementById('divPaymentIdentity').classList.remove('d-none');
                document.getElementById('divKey').classList.remove('d-none');
            }
            if (number == 2 ||  number == 3 || number == 4 || number == 5 || number == 6 || number == 7){
                document.getElementById('divPaymentIdentity').classList.add('d-none');
                document.getElementById('divKey').classList.add('d-none');
            }

        }




    </script>
@endsection
