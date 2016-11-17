@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Users</h2>
                    <div class="pull-right">
                        @permission('users-create')
                        <a href="{{ route('users.create') }}" class="btn btn-success">Create new user</a>
                        @endpermission
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td scope="row">{{ $user->id }}</td>
                                <td> <img width="60" src="{{ $user->avatar() }}"></td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">More</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            @permission('users-update')
                                            <li><a href="{{ route('users.edit', $user->id) }}">Edit</a></li>
                                            @endpermission

                                            @permission('users-delete')
                                            <li>
                                                @include('form.delete-button', ['route' => ['users.destroy', $user->id]])
                                            </li>
                                            @endpermission

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="pull-right">
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection