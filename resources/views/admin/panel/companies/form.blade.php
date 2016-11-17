@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Company crud form</h2>
                    <div class="pull-right">
                        @if (isset($item))
                            @permission('companies-delete')
                            @include('form.delete-button', ['route' => ['companies.destroy', $item->id], 'class' => 'btn btn-danger'])
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
                                @include('form.form-group', ['key' => 'name', 'label' => 'Name', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'email', 'label' => 'Email', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'phone', 'label' => 'Phone', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'voen', 'label' => 'VÖEN', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'user_full_name', 'label' => 'FullName of the man in charge', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'user_profession', 'label' => 'Profession of the man in charge', 'options' => ['class' => 'form-control']])
                            </div>
                            <div class="col-lg-6">
                                @include('form.form-group', ['type'=> 'textarea', 'key' => 'info', 'label' => 'Information', 'options' => ['rows' => 11,'class' => 'form-control']])
                                @include('form.form-group', ['key' => 'user_phone', 'label' => 'Phone of the man in charge', 'options' => ['class' => 'form-control']])
                                @include('form.form-group', ['key' => 'user_email', 'label' => 'Email of the man in charge', 'options' => ['class' => 'form-control']])
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                @include('form.form-group', ['key' => 'username', 'label' => 'UserName', 'options' => ['class' => 'form-control']])
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