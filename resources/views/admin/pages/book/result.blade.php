@extends('admin.layouts.master')

@section('title','نتیجه پرداخت')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('content')

{{-- breadcrumb --}}


<div class="card">
   <!-- Pricing Plans -->
   <div class="pricing-plans pb-sm-5 pb-2 rounded-top">
       @if($status == 1)
           <h2 class="text-center text-success">خرید شما با موفقیت انجام شد!</h2>
           <h5 class="text-center">شماره پیگیری: <code>{{ $message }}</code></h5>
           <a href="{{route('admin.book.library')}}" class="btn btn-secondary d-block mx-auto w-25">بازگشت به صغحه کتابخانه</a>
       @else
           <h2 class="text-center text-danger">{{ $message }}</h2>
           <a href="{{route('admin.book.index')}}" class="btn btn-secondary d-block mx-auto w-25">بازگشت به صغحه محصولات</a>
       @endif

   </div>
   <!--/ Pricing Plans -->
 </div>
@endsection




