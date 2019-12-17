@extends('layouts.template')

@section('title', 'Users')

@section('main')
    <h1>Users</h1>
    <form method="get" action="/admin/users" id="searchForm">
        @csrf
        <div class="row">

            <div class="col-sm-6 mb-2">
                <span>Filter Name Or Email</span>
                <input type="text" class="form-control" name="name_email" id="name_email"
                       value="{{ old('name_email') }}" placeholder="Filter Name Or Email">
            </div>
            <div class="col-sm-4 mb-2">
                <span>Sort by :</span>
                <select class="form-control" name="sortby" id="sortby">
                    <option value="name ASC" {{ old('sortby') == "name ASC" ? 'selected' : '' }}>Name (A -> Z)</option>
                    <option value="name DESC"  {{ old('sortby') == "name DESC" ? 'selected' : '' }}>Name (Z -> A)</option>
                    <option value="email ASC"  {{ old('sortby') == "email ASC" ? 'selected' : '' }}>Email (A -> Z)</option>
                    <option value="email DESC"  {{ old('sortby') == "email DESC" ? 'selected' : '' }}>Email (Z -> A)</option>
                    <option value="active DESC"  {{ old('sortby') == "active DESC" ? 'selected' : '' }}>Not active</option>
                    <option value="admin DESC" {{ old('sortby') == "admin DESC" ? 'selected' : '' }} >Admin</option>

                </select>
            </div>
            <div class="col-sm-2 mb-2">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
    <br>

    @include('shared.alert')

    <div class="table-responsive">

        <table class="table">
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
            <tbody>

            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->active)
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td>
                        @if($user->admin)
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td>
                        <form action="/admin/users/{{ $user->id }}" method="post" class="deleteForm">
                            @csrf
                            @method('delete')
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-outline-success  {{ auth()->user()->id == $user->id ? 'disabled' : '' }}"
                                   data-toggle="tooltip"
                                   title="Edit {{ $user->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Delete {{ $user->name }}" {{ auth()->user()->id == $user->id ? 'disabled' : '' }} >
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection