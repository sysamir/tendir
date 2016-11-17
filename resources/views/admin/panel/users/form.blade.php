@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>İstifadəçi üçün əsas məlumatlar</h2>
                    <div class="pull-right">
                        @if (isset($item))
                            @permission('users-delete')
                            @include('form.delete-button', ['route' => ['users.destroy', $item->id], 'class' => 'btn btn-danger'])
                            @endpermission
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {{ Form::open(['route' => $options['route'], 'method' => $options['method'], 'files' => true, 'class' => 'form-horizontal form-label-left']) }}

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['key' => 'full_name', 'label' => 'Full Name', 'options' => ['class' => 'form-control']])
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['type' => 'radio', 'key' => 'gender', 'label' => 'Gender', 'values' => config('user.gender')])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['key' => 'email', 'label' => 'Email', 'options' => ['data-inputmask' => "'alias' : 'email'",'placeholder' => 'Email', 'class' => 'form-control']])
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['type' => 'password', 'key' => 'password', 'label' => 'Password', 'options' => ['placeholder' => 'Password', 'class' => 'form-control']])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['key' => 'phone', 'label' => 'Phone number', 'options' => ['data-inputmask' => "'mask': '999-999-99-99'", 'placeholder' => '050-000-00-00', 'class' => 'form-control']])
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['key' => 'extra_phone', 'label' => 'Extra Phone Number', 'options' => ['data-inputmask' => "'mask': '999-999-99-99'", 'placeholder' => '050-000-00-00', 'class' => 'form-control']])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['key' => 'other_email', 'label' => 'Extra Email', 'options' => ['data-inputmask' => "'alias' : 'email'",'placeholder' => 'Extra Email', 'class' => 'form-control']])
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                @include('form.form-group', ['key' => 'birthday', 'label' => 'Birthday', 'options' => ['data-inputmask' => "'alias' : 'yyyy-mm-dd'", 'placeholder' => '1980-01-01', 'class' => 'form-control']])
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    @include('form.form-group', ['type' => 'textarea', 'key' => 'address', 'label' => 'Address', 'options' => ['class' => 'form-control']])
                                </div>
                            </div>
                        </div>
                    </div>


                    @include('form.submit-buttons')

                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection