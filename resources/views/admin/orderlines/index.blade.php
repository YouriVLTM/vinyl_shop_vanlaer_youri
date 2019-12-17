@extends('layouts.template')

@section('title', 'Orderline')

@section('main')

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm ml-2" id="back">
        <i class="fas fa-undo mr-1"></i>back
    </a>

    <h1>Orderline</h1>

    <table id="orders-table" class="table" data-id="{{$id}}">
        <thead>
        <tr>
            <th>#</th>
            <th>Artist</th>
            <th>Title</th>
            <th>Cover</th>
            <th>totalPrice</th>
            <th>Quantity</th>
            <th>created_at</th>
            <th>Action</th>
        </tr>
        </thead>
    </table>

@endsection

@section('script_after')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @include('admin.orderlines.script')
@endsection