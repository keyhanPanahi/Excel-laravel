@extends('admin.layouts.master')

@section('title','فهرست تراکنش ها')

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
        <li class="breadcrumb-item active">فهرست تراکنش ها</li>
    </ol>
</nav>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover table-striped text-center" id="myTable">
                <thead>
                    <tr>
                        <th>کد پرداخت</th>
                        <th>کاربر</th>
                        <th>محصول</th>
                        <th>قیمت</th>
                        <th>وضعیت</th>
                        <th>کد تراکنش</th>
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

    <script>
        $(function () {
            var table = $('#myTable').DataTable({
                "aoColumnDefs": [
                    // { "bSortable": false, "aTargets": [ 7 ] },
                ],
                pageLength: 10,
                processing: true,
                serverSide: true,
                // responsive: true,
                ajax: '{{ route('admin.transactionShow') }}',
                columns: [
                    { data: 'payment_id', name: 'payment_id'},
                    { data: 'user', name: 'user'},
                    { data: 'book', name: 'book'},
                    { data: 'paid', name: 'paid'},
                    { data: 'status', name: 'status'},
                    { data: 'transaction_id', name: 'transaction_id'},

                ],
            });
        });
    </script>
@endsection
