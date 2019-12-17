@extends('layouts.template')

@section('title', 'Users (Expert)')

@section('main')
    <h1>Users (Expert)</h1>

        <table id="users-table" class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>

    @include('admin.users3.modal')
    @include('admin.users3.passwordmodal')
@endsection

@section('script_after')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    @include('admin.users3.script')
@endsection