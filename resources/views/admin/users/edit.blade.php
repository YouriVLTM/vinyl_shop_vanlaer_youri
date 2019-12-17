@extends('layouts.template')

@section('title', 'Edit User')

@section('main')
    <h1>Edit User: {{ $user->name }}</h1>
    <form action="/admin/users/{{ $user->id }}" method="post">
        @method('put')
        @include('admin.users.form')
    </form>
@endsection