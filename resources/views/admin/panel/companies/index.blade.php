@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Companies</h2>
                    <div class="pull-right">
                        @permission('companies-create')
                        <a href="{{ route('companies.create') }}" class="btn btn-success">Create new company</a>
                        @endpermission
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <td>Logo</td>
                            <th>Name</th>
                            <th>UserName</th>
                            <th>PersonİnCharge</th>
                            <th>Phone</th>
                            <th>VÖEN</th>
                            <th>Rating</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td scope="row">{{ $company->id }}</td>
                                <td> <img width="60" src="{{ $company->logo() }}"></td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->username }}</td>
                                <td>
                                    {{ $company->user_full_name }} ({{ $company->user_profession }})
                                </td>
                                <td>{{ $company->phone }}</td>
                                <td>{{ $company->voen }}</td>
                                <td>{{ $company->rating }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">More</button>
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">

                                            @permission('companies-update')
                                            <li><a href="{{ route('companies.edit', $company->id) }}">Edit</a></li>
                                            @endpermission

                                            @permission('companies-delete')
                                            <li>
                                                @include('form.delete-button', ['route' => ['companies.destroy', $company->id]])
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