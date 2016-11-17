@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Roles</h2>
                    <div class="pull-right">
                        @permission('roles-create')
                        <a href="{{ route('roles.create') }}" class="btn btn-success">Create new role</a>
                        @endpermission
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>case_name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            <th>Admins</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td scope="row">{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{!! $role->description !!}</td>
                                <td>{!! $role->users_count !!}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">More</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            @permission('roles-update')
                                            <li><a href="{{ route('roles.edit', $role->id) }}">Edit</a></li>
                                            @endpermission

                                            @permission('roles-delete')
                                            <li>
                                                @include('form.delete-button', ['route' => ['roles.destroy', $role->id]])
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