@extends('layouts.admin')
@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Dashboard</a></li>
        <li class="active">Template variations</li>
    </ol>

    <div class="row">
        {{--@if(isset($sections))--}}
        {{--@include('packeges::templates.section_variation')--}}
        {{--@else--}}
        <div id="var_listind" class="col-md-8  table-responsive p-0">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Variations for [{{ $template->title }}] template
                        <a href="javascript:void(0)" class="btn btn-xs btn-success pull-right" id="new-variation"
                           style="color:#fff;">Add Layout</a>
                    </h4>
                </div>
                <div class="panel-body">
                    <table width="100%" class="table table-bordered m-0">
                        <thead>
                        <tr class="bg-black-darker text-white">
                            <th>Variation Name</th>
                            @if(isset($sections))
                                <th>Linked To</th>
                            @endif
                            @if(isset($taxonomies))
                                <th>Linked To</th>
                            @endif
                            <th width="150">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($variations as $variation_data)
                            <tr>
                                <td><a href="#" class="editable" data-type="text" data-pk="{{$variation_data->id}}"
                                       data-title="Template Variation Title">{{$variation_data->title}}</a></td>
                                <td>
                                    @if( $template->type=="widget")
                                        <a href="/admin/templates/widget-settings/{{$variation_data->id}}"
                                           class="btn btn-default btn-warning btn-xs">&nbsp;<i class="fa fa-cog"></i>&nbsp;</a>
                                    @endif
                                    <a href="/admin/templates/settings-live/{{$variation_data->id}}"
                                       class="btn btn-default btn-warning btn-xs">&nbsp;<i class="fa fa-cog"></i>&nbsp;</a>
                                    @if(!$variation_data->main)
                                        <button value="{{$variation_data->id}}"
                                                class="btn btn-info btn-xs edit-variation">&nbsp;<i
                                                    class="fa fa-pencil"></i>&nbsp;
                                        </button>
                                        <a href="/admin/templates/delete-variation/{{$variation_data->id}}/{{$template->id}}"
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

        <div class="col-md-4 new-variation @if(empty($variation)) hide @endif">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        @if(!empty($variation))
                            Edit Template Variation
                        @else
                            New Template Variation
                        @endif
                    </h4>
                </div>
                <div class="panel-body">
                    {!! Form::model('customiser',['method'=>'POST','url'=>'/admin/templates/tpl-variations/'.$template->slug]) !!}
                    {!! Form::hidden('template_slug',$template->slug) !!}
                    @if(!empty($variation))
                        {!! Form::hidden('variation_id',$variation['id']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('title','Varitation Name') !!}
                        {!! Form::text('title',issetReturn($variation, 'variation_name'), ['class' => 'form-control']) !!}
                    </div>
                    @if(isset($sections))
                        <div class="form-group">
                            {!! Form::label('section','Section') !!}
                            {!! Form::select('section_id',[null=>'Select section']+$sections,issetReturn($variation, 'section'),['class' => 'form-control']) !!}
                        </div>
                        @if(empty($variation))
                            <div class="form-group">
                                {!! Form::label('make_active','Make active') !!}
                                {!! Form::checkbox('make_active','active', false) !!}
                            </div>
                        @endif
                    @endif
                    <button class="btn btn-sm btn-success mrg-btm-10" type="submit"><i class="fa fa-save"></i> Save
                        Variation
                    </button>
                    <button class="btn btn-sm btn-default mrg-btm-10 cancel" type="button">Cancel</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        {{--@endif--}}

    </div>

@stop

@section('CSS')
    {!! HTML::style('js/bootstrap-editable/css/bootstrap-editable.css') !!}
@stop

@section('JS')
    {!! HTML::script('js/bootstrap-editable/js/bootstrap-editable.min.js') !!}

    <script>

        $(document).ready(function () {
            $.fn.editable.defaults.mode = 'inline';
            //make status editable
            $('.editable').editable({
                url: '/admin/resources/templates/editvariation',
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
                $('#edit_variation_form').remove();
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

        $('.edit-variation').on('click', function () {
            $('.new-variation').addClass('hide');
            $('#edit_variation_form').remove();
            var data = {'id': $(this).val()}
            $.ajax({
                type: "post",
                url: "{!! url('/admin/resources/templates/get-variations') !!}",
                cache: false,
                datatype: "json",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $("#token").val()
                },
                success: function (data) {
                    if (data) {
                        $('#edit_variation_form').remove();
                        $(data.html).insertAfter('#var_listind');
                    }
                }
            });
        })
    </script>
@stop
