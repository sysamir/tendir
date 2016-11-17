@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Roles crud form</h2>
                    <div class="pull-right">
                        @if (isset($item))
                            @permission('roles-delete')
                            @include('form.delete-button', ['route' => ['roles.destroy', $item->id], 'class' => 'btn btn-danger'])
                            @endpermission
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    {{ Form::open(['route' => $options['route'], 'method' => $options['method'], 'files' => true, 'class' => 'form-horizontal form-label-left']) }}

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                @include('form.form-group', ['key' => 'name', 'label' => 'case_name', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'display_name', 'label' => 'Display Name', 'options' => ['class' => 'form-control']])
                            </div>
                            <div class="col-lg-6">
                                @include('form.form-group', ['type'=> 'textarea', 'key' => 'description', 'label' => 'Description', 'options' => ['rows' => 5,'class' => 'form-control']])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <h3>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="select_all"/>Check All (Permissions)
                                    </label>
                                </div>
                            </h3>


                        </div>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-lg-3 margin-bottom-10">
                                    <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('permissions[]', $permission->id, (isset($item) ? (in_array($permission->id, $rolePermissions) ? true : false) : false), ['class' => 'check-box' ]) }} {{ $permission->display_name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @include('form.submit-buttons')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection