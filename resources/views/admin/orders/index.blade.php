@extends('layouts.template')

@section('title', 'Orders')

@section('main')
    <h1>Orders</h1>

    <table id="orders-table" class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>User name</th>
            <th>TotalPrice</th>
            <th>created_at</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>

@endsection

@section('script_after')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @include('admin.orders.script')
@endsection