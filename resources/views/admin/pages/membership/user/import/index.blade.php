@extends('admin.layouts.master')

@section('title','مشاهده کاربر')

@section('vendor-css')
    <!-- form-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.membership.user.index') }}">فهرست کاربران</a></li>
            <li class="breadcrumb-item active">وارد کردن فایل</li>
        </ol>
    </nav>

        <div class="row">
            <div class="col-xl-12 col-lg-7 col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>برای آپلود، نمونه فایل را دانلود کرده و بر اساس نمونه فایل، فایل خود را آپلود کنید!</h5>
                        <div class="my-2">
                            <a href="{{ route('admin.membership.user.import.sample') }}" class="btn btn-primary"><i class="bx bx-download"></i> دانلود نمونه فایل</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-7 col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="my-2">
                            <form action="{{ route( 'admin.membership.user.import.upload') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input class="form-control mb-3" type="file" name="importFile">
                                <button type="submit" class="btn btn-success">ثبت</button>
                            </form>
                        </div>
                        <div class="mb-1">
                            @error('importFile')
                            <span class="text-danger"> * {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
@endsection

@section('vendor-js')
    <!-- form-->
    <script src="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('admin-assets/js/form-wizard-numbered.js') }}"></script>
@endsection
