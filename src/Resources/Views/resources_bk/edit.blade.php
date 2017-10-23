@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb bordr-title">
        <li><a href="/admin"><i class="fa fa-dashboard"></i> &nbsp;Dashboard</a></li>
        <li><a href="/admin/resources/core_assest/create"><i class="fa fa-th"></i> &nbsp;Assets</a></li>
        <li class="active">Create</li>
    </ol>
    <div class="row">
        <div class="col-md-12 table-responsive">
            {!! Form::model($asset,['url'=>'/admin/resources/core_assest/update' , 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('id', $asset->id) !!}
            @include('resources::resources._form',['submitButtonText'=>'Save Changes'])
            {!! Form::close() !!}
        </div>
    </div>

@stop 
