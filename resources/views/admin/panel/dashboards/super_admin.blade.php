@extends('layouts.admin')

@section('content')

    @permission('statistics-view')
        @widget('statistics')
    @endpermission

@endsection