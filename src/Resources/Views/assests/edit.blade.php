@extends('layouts.admin')

@section('content')

    {!! Breadcrumbs::render('update_assest') !!}

    <div class="row">
        <div class="col-md-12 table-responsive">
            {!! Form::model($asset,['url'=>'/admin/resources/core_assest/update' , 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('id', $asset->id) !!}
            @include('resources::assests._form',['submitButtonText'=>'Save Changes'])
            {!! Form::close() !!}
        </div>
    </div>

@stop 
