@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Admin crud form</h2>
                    <div class="pull-right">
                        @if (isset($item))
                            @permission('admins-delete')
                            @include('form.delete-button', ['route' => ['admins.destroy', $item->id], 'class' => 'btn btn-danger'])
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
                                @include('form.form-group', ['key' => 'name', 'label' => 'Full name', 'options' => ['class' => 'form-control']])
                            </div>
                            <div class="col-lg-6">
                                @include('form.form-group', ['type' => 'select', 'key' => 'role_id', 'label' => 'Role', 'selects' => $roles, 'options' => ['class' => 'form-control']])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                @include('form.form-group', ['key' => 'email', 'label' => 'Email', 'options' => ['data-inputmask' => "'alias' : 'email'",'placeholder' => 'Email', 'class' => 'form-control']])
                            </div>
                            <div class="col-lg-6">
                                @include('form.form-group', ['type' => 'password', 'key' => 'password', 'label' => 'Password', 'options' => ['placeholder' => 'Password', 'class' => 'form-control']])
                            </div>
                        </div>
                    </div>

                    @include('form.submit-buttons')

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection