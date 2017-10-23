@extends('layouts.admin')
@section('content')
    <ol class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li class="active">{!! $classes->name !!}</li>
    </ol>
    <div class="row">
        {{--@if(isset($sections))--}}
        {{--@include('packeges::templates.section_variation')--}}
        {{--@else--}}
        <div class="col-md-8 table-responsive p-0">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Variations for [{{ $classes->name }}] template

                        {{--@if(!empty($variation))--}}
                        {{--<a href="{!! url('/admin/resources/classes/create-text-class') !!}" class="btn btn-success" style="float: right;">+new--}}
                        {{--text class</a>--}}
                        <a href="{{URL('/admin/resources/classes/create-class-variations',$classes->id)}}"
                           class="btn btn-xs btn-success pull-right" style="color:#fff;">New Variation</a>
                        {{--@else--}}
                        {{--<a href="javascript:;" class="btn btn-xs btn-success pull-right" style="color:#fff;" id="new-variation">New Variation</a>--}}
                        {{--@endif--}}
                    </h4>
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-bordered m-0">
                        <thead>
                        <tr class="bg-black-darker text-white">
                            <th>Variation Name</th>
                            {{--@if(isset($sections))--}}
                            {{--<th>Linked To</th>--}}
                            {{--@endif--}}
                            <th width="120">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($variations as $variation_data)
                            <tr>
                                <td>
                                    <a href="#" class="editable">{!! $variation_data->title !!}</a>
                                </td>

                                <td>
                                    <a href="{!! url('/admin/resources/classes/edit-class-variation',$variation_data->id) !!}"
                                       class="btn btn-primary btn-xs">&nbsp;<i class="fa fa-desktop"></i>&nbsp;</a>
                                    @if($variation_data->role)
                                        <a href="{!! url('/admin/resources/classes/delete-variation',$variation_data->id) !!}"
                                           class="btn btn-danger btn-xs"
                                           onclick="return confirm('Are you sure to delete')"> &nbsp;<i
                                                    class="fa fa-trash"></i> &nbsp;</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {!! Form::open(['class'=>'form-horizontal','files'=>true]) !!}
            <fieldset>

                <!-- Form Name -->
                <legend>Upload css</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="title">Variation name</label>
                    <div class="col-md-8">
                        {!! Form::text('title',null,['class'=>'form-control']) !!}

                    </div>
                </div>
                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="css">CSS</label>
                    <div class="col-md-4">
                        {!! Form::file('css',['class'=>'input-file']) !!}
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for=""></label>
                    <div class="col-md-4">
                        <button id="" name="" class="btn btn-primary">Upload</button>
                    </div>
                </div>

            </fieldset>
            {!! Form::close() !!}

        </div>

        <div class="col-md-4 new-variation @if(empty($classes)) hide @endif">

            {{--@endif--}}


        </div>

        @stop

        @section('CSS')
            {!! HTML::style('/public/libs/bootstrap-editable/css/bootstrap-editable.css') !!}
        @stop

        @section('JS')
            {!! HTML::script('/public/libs/bootstrap-editable/js/bootstrap-editable.min.js') !!}

            <script>
                $(document).ready(function () {
                    $.fn.editable.defaults.mode = 'inline';
                    //make status editable
                    $('.editable').editable({
                        url: '/admin/templates/editvariation',
                        params: function (params) {
                            params._token = $('#token').val();
                            return params;
                        },
                        send: 'always',
                        ajaxOptions: {
                            dataType: 'html'
                        }
                    });

                    $('#new-variation').click(function () {
                        $('.new-variation').removeClass('hide');
                    });

                    $('.new-variation-section').click(function () {
                        $('#variation-section').val($(this).attr('data-section'));
                        $('.new-variation').removeClass('hide');
                    });

                    $('.myTabs li:eq(0) a').tab('show');

                    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                        $('.new-variation').addClass('hide');
                    })

                    $('.cancel').click(function () {
                        $('.new-variation').addClass('hide');
                    });

                });
            </script>
@stop
