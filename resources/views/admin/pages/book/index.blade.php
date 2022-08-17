@extends('admin.layouts.master')

@section('title','مدیریت - فهرست سازمان ها')

@section('vendor-css')
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection

@section('content')

{{-- breadcrumb --}}
<nav aria-label="breadcrumb mb-3">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
      <li class="breadcrumb-item active" aria-current="page">فهرست محصولات ها</li>
    </ol>
</nav>

<div class="card">
   <!-- Pricing Plans -->
   <div class="pricing-plans pb-sm-5 pb-2 rounded-top">
     <div class="container py-5">

       <div class="row mx-0 gy-3">
         @foreach ($books as $book)

         <!-- Exclusive -->
         <div class="col-xl mb-lg-0 lg-4">
           <div class="card border border-2 border-primary">
             <div class="card-body">

               <div class="text-center position-relative mb-4 pb-3">
                 <div class="d-flex">
                   <h1 class="price-toggle text-primary price-yearly mb-0"> <small>نام:</small>{{ $book->title}} </h1>
                 </div>
                 <h4 class="position-absolute start-0 m-auto price-yearly price-yearly-toggle text-muted">{{ $book->price}} تومان </h4>
               </div>

               <hr>

               <ul class="list-unstyled pt-2 pb-1 lh-1-85">
                 <li class="mb-2">
                   <span class="badge badge-center align-middle w-px-20 h-px-20 rounded-pill bg-label-primary me-2">
                     <i class="bx bx-food-menu bx-xs"></i>
                   </span>خلاصه :
                     {{ Str::limit($book->description,150).'....'}}
                 </li>
               </ul>

               <a href="{{ route('admin.book.purchase',$book->id) }}" class="btn btn-primary d-grid w-100">خرید</a>
             </div>
           </div>
         </div>

         @endforeach

       </div>
     </div>
   </div>
   <!--/ Pricing Plans -->
 </div>
@endsection


@section('vendor-js')
    <script src="{{ asset('admin-assets/vendor/libs/datatables/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
@endsection
