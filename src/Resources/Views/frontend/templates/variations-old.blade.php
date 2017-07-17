@extends('layouts.admin')
@section('content')

    <ol class="breadcrumb">
        <li><a href="/">Dashboard</a></li>

        <li class="active">{!! $title !!}</li>
    </ol>

    <div class="row">
        {{--@if(isset($sections))--}}
            {{--@include('packeges::templates.section_variation')--}}
        {{--@else--}}
            <div class="col-md-8 table-responsive p-0">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            Variations for [{{ $template->title }}] template

                            @if(!empty($variation))
                                <a href="{{URL('/admin/templates/variations/'.$template->id)}}" class="btn btn-xs btn-success pull-right" style="color:#fff;">New Variation</a>
                            @else
                                <a href="javascript:;" class="btn btn-xs btn-success pull-right" style="color:#fff;" id="new-variation">New Variation</a>
                            @endif
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
                                <th width="120">Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($variations as $variation_data)
                                <tr>
                                    <td><a href="#" class="editable" data-type="text" data-pk="{{$variation_data->id}}" data-title="Template Variation Title">{{$variation_data->variation_name}}</a></td>
                                    @if(isset($sections))
                                        <td>
                                            @if($variation_data->section_id && BBgetSection($variation_data->section_id))
                                                <span class="badge"> {!! BBgetSection($variation_data->section_id)->blog_slug !!}  Section</span>
                                            @elseif($variation_data->post_id && BBGetPost($variation_data->post_id))
                                                <span class="badge"> {!! BBGetPost($variation_data->post_id)->post_title !!} Post</span>
                                            @endif
                                        </td>
                                    @endif
                                    @if(isset($taxonomies))
                                        <td>
                                            @if($variation_data->taxonomy_id && BBgetTaxonomy($variation_data->taxonomy_id))
                                                <span class="badge"> {!! BBgetTaxonomy($variation_data->taxonomy_id)->slug !!} Taxonomy</span>
                                            @elseif($variation_data->term_id && BBgetTerm($variation_data->term_id))
                                                <span class="badge"> {!! BBgetTerm($variation_data->term_id)->term_slug !!} Term</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if( $template->type=="widget")
                                            <a href="/admin/templates/widget-settings/{{$variation_data->id}}" class="btn btn-default btn-warning btn-xs">&nbsp;<i class="fa fa-cog"></i>&nbsp;</a>
                                        @endif

                                        <a href="/admin/templates/mapping/{{$variation_data->id}}" class="btn btn-primary btn-xs">&nbsp;<i class="fa fa-desktop"></i>&nbsp;</a>

                                        <a href="/admin/templates/variations/{{$template->id}}/{{$variation_data->id}}" class="btn btn-info btn-xs">&nbsp;<i class="fa fa-pencil"></i>&nbsp;</a>
                                        @if($variation_data->type != 'core')
                                        <a href="/admin/templates/delete-variation/{{$variation_data->id}}/{{$template->id}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete')"> &nbsp;<i class="fa fa-trash"></i> &nbsp;</a>
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
                        {!! Form::model('customiser',['method'=>'POST','url'=>'/admin/templates/variations/'.$template->id]) !!}
                        {!! Form::hidden('template_id',$template->id) !!}
                        @if(!empty($variation))
                            {!! Form::hidden('variation_id',$variation['id']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('variation_name','Varitation Name') !!}
                            {!! Form::text('variation_name',issetReturn($variation, 'variation_name'), ['class' => 'form-control']) !!}
                        </div>
                        @if(isset($sections))
                            <div class="form-group">
                                {!! Form::label('section','Section') !!}
                                {!! Form::select('section',$sections,issetReturn($variation, 'section'),['class' => 'form-control']) !!}
                            </div>
                            @if(empty($variation))
                                <div class="form-group">
                                    {!! Form::label('make_active','Make active') !!}
                                    {!! Form::checkbox('make_active','active', false) !!}
                                </div>
                            @endif
                        @endif
                        <button class="btn btn-sm btn-success mrg-btm-10" type="submit"><i class="fa fa-save"></i> Save Variation</button>
                        <button class="btn btn-sm btn-default mrg-btm-10 cancel" type="button">Cancel</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        {{--@endif--}}



    </div>

@stop

@section('CSS')
    {!! HTML::style('/public/libs/bootstrap-editable/css/bootstrap-editable.css') !!}
@stop

@section('JS')
    {!! HTML::script('/public/libs/bootstrap-editable/js/bootstrap-editable.min.js') !!}

    <script>
        $(document).ready(function() {
            $.fn.editable.defaults.mode = 'inline';
            //make status editable
            $('.editable').editable({
                url: '/admin/templates/editvariation',
                params:function(params) {
                    params._token = $('#token').val();
                    return params;
                },
                send:'always',
                ajaxOptions: {
                    dataType: 'html'
                }
            });

            $('#new-variation').click(function(){
                $('.new-variation').removeClass('hide');
            });

            $('.new-variation-section').click(function(){
                $('#variation-section').val($(this).attr('data-section'));
                $('.new-variation').removeClass('hide');
            });

            $('.myTabs li:eq(0) a').tab('show');

            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                $('.new-variation').addClass('hide');
            })

            $('.cancel').click(function(){
                $('.new-variation').addClass('hide');
            });

        });
    </script>
@stop
