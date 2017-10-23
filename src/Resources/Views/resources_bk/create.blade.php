@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb bordr-title">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a></li>
        <li><a href="/admin/resources/core_assest/create"><i class="fa fa-th"></i> &nbsp;Assets</a></li>
        <li class="active">Create</li>
    </ol>
    <div class="row">
        <div class="col-md-12 table-responsive">
            {!! Form::model(['url'=>'/admin/resources/core_assest/create' , 'class' => 'form-horizontal']) !!}
            @include('resources::resources._form',['submitButtonText'=>'Add New Assest'])
            {!! Form::close() !!}
        </div>
    </div>

@stop 
