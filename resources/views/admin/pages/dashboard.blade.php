@extends('admin.layouts.master')

@section('title','مدیریت - داشبورد')

@section('content')

{{-- breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">کاربران</li> --}}
    </ol>
</nav>

@endsection
