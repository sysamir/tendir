@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Admins</h2>
                    <div class="pull-right">
                        @permission('admins-create')
                        <a href="{{ route('admins.create') }}" class="btn btn-success">Create new admin</a>
                        @endpermission
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td scope="row">{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->role->display_name or null  }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">More</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            @permission('admins-update')
                                            <li><a href="{{ route('admins.edit', $admin->id) }}">Edit</a></li>
                                            @endpermission

                                            @permission('admins-delete')
                                            <li>
                                                @include('form.delete-button', ['route' => ['admins.destroy', $admin->id]])
                                            </li>
                                            @endpermission

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection