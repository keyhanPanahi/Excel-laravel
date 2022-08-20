@extends('admin.layouts.master')

@section('title','تنظیمات پرداخت')

@section('vendor-css')
    <!-- data table -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        <li class="breadcrumb-item active">تنظیمات پرداخت</li>
    </ol>
</nav>



{{--    <div class="d-flex justify-content-between bd-highlight">--}}
{{--        <div class="p-2 bd-highlight">--}}
{{--            <a href="{{ route('admin.membership.user.create') }}" class="btn btn-primary " title="ایجاد کاربر"><i class="bx bx-user-plus"></i></a>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover table-striped text-center" id="myTable">
                <thead>
                    <tr>
                        <th>نام</th>
                        <th>username</th>
                        <th>password</th>
                        <th>merchant_id</th>
                        <th>terminal_id</th>
                        <th>key</th>
                        <th>Payment_Identity</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('vendor-js')
    <!-- data table-->
    <script src="{{ asset('admin-assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <!-- select2-->
    <script src="{{ asset('admin-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/select2/i18n/fa.js') }}"></script>

@endsection

@section('page-js')

    <!-- DataTable-->
    <script>
        $(function () {
            var table = $('#myTable').DataTable({
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 7 ] },
                    { "bSortable": false, "aTargets": [ 8 ] },
                    { "bSearchable": false, "aTargets": [ 7 ] }
                ],
                pageLength: 10,
                processing: true,
                serverSide: true,
                // responsive: true,
                ajax: '{{ route('admin.payment.setting.index') }}',
                columns: [
                    { data: 'name', name: 'name'},
                    { data: 'username', name: 'username'},
                    { data: 'password', name: 'password'},
                    { data: 'merchant_id', name: 'merchant_id'},
                    { data: 'terminal_id', name: 'terminal_id'},
                    { data: 'key', name: 'key'},
                    { data: 'PaymentIdentity', name: 'PaymentIdentity'},
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action'},
                ],
            });
        });
    </script>
@endsection
