@extends('AdminPanel.layouts.main')
@section('main-section')
    <div class="container">
        <div class="container-fluid">
            <div class="mt-4 ">
                <h2>Users</h2>
                <div aria-label="breadcrumb mt-5">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Users</li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
            <div id="alert"
                class="{{ session()->get('msgst') ? 'alert  alert-' . session()->get('msgst') : 'm-0 border-0 p-0' }}">
                {{ session()->get('msg') ?? null }}</div>
            <div class="mt-4">
                <form action="{{ route('admin.update_user_type') }}" method="POST">
                    @csrf
                    <table class="table table-hover table-striped" id="data">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Type</th>
                                @if (session()->get('AdminUser')['type'] == 'R')
                                    <th scope="col">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersData as $item)
                                <tr>
                                    <th scope="row">{{ $item->id }}</th>
                                    <th scope="row"><img class="rounded" height="32" width="32"
                                            src="{{ !empty($item->Data->image) ? asset('/storage/userdata/' . $item->Data->image) : asset('stockUser.png') }}"
                                            alt=""></th>
                                    <th scope="row">{{ $item->name }}</th>
                                    <th scope="row">{{ $item->email }}</th>
                                    <th scope="row">
                                        <select class="form-control type" name="user_type[{{ $item->id }}]">
                                            <option @if ($item->type == 'A') selected @endif value="A">Admin</option>
                                            <option @if ($item->type == 'U') selected @endif value="U">User</option>
                                        </select>
                                    </th>
                                    @if (session()->get('AdminUser')['type'] == 'R')
                                        <th scope="row">
                                            <a class="btn btn-danger btn-sm" onclick="confirm('Sure to delete?')"
                                                href="{{ route('del_users', $item->id) }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </th>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Update User Types</button>
                </form>
            </div>
        </div>
    </div>
@endsection
