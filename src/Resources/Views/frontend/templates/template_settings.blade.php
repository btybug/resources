@extends('layouts.admin')

@section('content')
    {!! Form::open(['url'=>'/admin/templates/setting', 'id'=>'add_custome_page','files'=>true]) !!}

    {!! Form::hidden('id', $variation_id) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bg-black-darker text-white">Template settings</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="">Select Menu</label>
                        <select name="" id="" class="form-control">
                            @foreach(BBGetMenus() as $menu)
                                <option value="{{$menu['id']}}">{{$menu['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Header Background</label>
                        <select name="" id="" class="form-control">
                            <option value="">Default</option>
                            <option value="">Custom</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('JS')

@stop
