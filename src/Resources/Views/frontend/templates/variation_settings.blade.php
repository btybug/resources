@extends('layouts.admin')

@section('content')
    {!! Breadcrumbs::render('template_settings') !!}

    {!! Form::model($settings,['files'=>true,'class' => 'form-horizontal']) !!}
    {!! Form::hidden('id', $variation->id) !!}
        <div class="row">
            {!! $path  !!}

            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="settings_savebtn" class="btn btn-success btn-block" type="submit">Save Changes</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@stop
@section('JS')
@stop 
