@extends('layouts.admin')

@section('content')

    {!! Breadcrumbs::render('update_resources') !!}

    <div class="row">
        <div class="col-md-12 table-responsive">
            {!! Form::model(['url'=>'/admin/resources/core_resources/create' , 'class' => 'form-horizontal']) !!}
            @include('resources::resources._form',['submitButtonText'=>'Add New Resource'])
            {!! Form::close() !!}
        </div>
    </div>

@stop 
