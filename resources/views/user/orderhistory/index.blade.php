@extends('layouts.template')

@section('title', 'History')

@section('main')
    <h1>Orders history</h1>

    <table id="orders-table" class="table" data-user="">
        <thead>
        <tr>
            <th>#</th>
            <th>TotalPrice</th>
            <th>created_at</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>

    @include('user.orderhistory.modal')
@endsection

@section('script_after')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @include('user.orderhistory.script')
@endsection