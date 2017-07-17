@extends('layouts.admin')
@section('content')
    {!! HTML::style('/app/Modules/Resources/Resources/assets/css/new-store.css') !!}
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 cms_module_list">
            <h3 class="menuText f-s-17">
                <span class="module_icon_main"></span>
                <span class="module_icon_main_text"> Templates </span>
            </h3>
            <hr>
            <ul class="list-unstyled menuList" id="components-list">
                {{--main types--}}
                @if($types)
                    @foreach($types as $v)
                        <li>
                            <a href="?p={!! $v['foldername'] !!}" rel="tab" main-type="{{ $v['foldername'] }}" class="tpl-left-items">
                                <span class="module_icon"></span> {{ $v['title'] }}
                                @if($v['foldername'] == 'body')
                                    <a href="javascript:void(0)" class="add-new-type pull-right"><i
                                                class="fa fa-plus-circle"></i></a>
                                @endif
                            </a>
                        </li>
                        @if(isset($v['subs']) and count($v['subs']))
                            @foreach($v['subs'] as $sub)
                                <li class="m-l-30" style="width: 90%;">
                                    <a href="?p={!! $v['foldername'] !!}" type="{!! $v['foldername'] !!}" main-type="{{ $sub['foldername'] }}"
                                       class="tpl-left-items">
                                        <span class="module_icon"></span> {{ $sub['title'] }}
                                        @if($sub['type'] != 'core')
                                            <a class="remove-type pull-right" data-folder="{{ $sub['foldername'] }}"
                                               href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 templates_1111">
            <div class="row template-search div_top_31">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9 template-search-box m-t-10 m-b-10 ">
                    <form class="form-horizontal form_sort_31">
                        <div class="form-group m-b-0">
                            <label for="inputEmail3" class="col-xs-12 col-sm-3 control-label">Sort By</label>
                            <div class="col-sm-6 for_select_11">
                                <select class="form-control sort-items">
                                    <option>Recently Added</option>
                                </select>
                            </div>
                            <div class="col-sm-2 pull-right for_search_20">
                                <a class="btn btn-default"><i class="fa fa-search f-s-15" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 template-upload-button p-l-0 p-r-0">
                    <button class="btn btn-sm  pull-right m-b-10 " type="button" data-toggle="modal"
                            data-target="#uploadfile">
                        <span class="module_upload_icon m-l-20"></span>
                        <span class="upload_module_text">Upload</span>
                    </button>
                </div>
            </div>
            <div class="templates-list  m-t-20 m-b-10">
                <div class="row templates m-b-10">
                    {!! HTML::image('resources/assets/images/ajax-loader5.gif', 'a picture', array('class' => 'thumb img-loader hide')) !!}
                    <div class="raw tpl-list">
                        @include('resources::frontend.templates._partrials.tpl_list')
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="uploadfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/admin/templates/upload-template','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}
                    {!! Form::hidden('type','header',['id' => 'tpl_type']) !!}
                    {!! Form::close() !!} </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addNewType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="height: 200px;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Type</h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'/admin/templates/new-type']) !!}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                Enter Type :
                            </label>
                            {!! Form::text('title',null,['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Add',['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!} </div>
            </div>
        </div>
    </div>
@stop
@section('CSS')
    {!! HTML::style('app\Modules\Resources\Resources\assets\css\style_cube.css') !!}
    <style>
        .child-tpl {
            width: 95% !important;
        }

        .img-loader {
            width: 70px;
            height: 70px;
            position: absolute;
            top: 50px;
            left: 40%;
        }
    </style>
@stop
@section('JS')
    {!! HTML::script('resources/assets/js/dropzone/js/dropzone.js') !!}
    <script>
        Dropzone.options.myAwesomeDropzone = {
            init: function () {
                this.on("success", function (file) {
                    location.reload();
                });
            }
        };

        $(document).ready(function () {
            var p="{!! $_GET['p'] or null !!}";

            $("body").on("click", ".add-new-type", function () {
                $('#addNewType').modal();
            });



            $('.list-unstyled').on('click', '.tpl-left-items', function(e) {
                var main_type = $(this).attr('main-type');
                var general_type = $(this).attr('type');
                var pageurl = $(this).attr('href');

                $('.tpl-left-items').removeClass('active');
                if (general_type) {
                    $('*[main-type="body"]').addClass('active');
                    $('*[main-type="' + main_type + '"]').addClass('active');
                } else {
                    $('*[main-type="' + main_type + '"]').addClass('active');
                }
                $('#tpl_type').val(main_type);
                $.ajax({
                    url: '/admin/templates/templates-with-type',
                    data: {
                        main_type: main_type,
                        url:pageurl+'?rel=tab',
                        type: general_type
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('.tpl-list').html('');
                        $('.img-loader').removeClass('hide');
                    },
                    headers: {
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    success: function (data) {
                        $('.img-loader').addClass('hide');
                        if (!data.error) {

                            $('.tpl-list').html(data.html);
                        }
                    },
                    type: 'POST'
                });
                if(pageurl!=window.location){
                    window.history.pushState({path:pageurl},'',pageurl);
                }
                return false;
            });

            $("a[main-type="+p+"]").click();

            $('body').on('click', '.del-tpl', function () {
                var slug = $(this).attr('slug');
                $.ajax({
                    url: '/admin/templates/delete',
                    data: {
                        slug: slug
                    },
                    headers: {
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    type: 'POST'
                });
            });

            $('body').on('click', '.remove-type', function () {
                var folder = $(this).attr('data-folder');
                $.ajax({
                    url: '/admin/templates/delete-type',
                    data: {
                        folder: folder
                    },
                    headers: {
                        'X-CSRF-TOKEN':$("input[name='_token']").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        location.reload();
                    },
                    type: 'POST'
                });
            });
        });
    </script>
@stop